<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class reserve extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utilmodel');
        $this->load->model('reservemodel');
        $this->load->model('roommodel');
    }

    public function book() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        // $data['reservations'] = $this->utilmodel->get_reservation_data();
        // Prepare information for the form 
        // Get Booking Purpose
        $criteria_purpose['vchparamtype'] = "reserve_purpose";
        $order_purpose ['vchparamcode'] = "vchparamcode";
        $data['reserve_purpose'] = $this->utilmodel->selectByExample("parameters", $criteria_purpose, $order_purpose);

        // Get Blocks
        $criteria_booking_status['vchparamtype'] = "booking_status";
        $order_booking_status ['id'] = "id";
        $data['booking_status'] = $this->utilmodel->selectByExample("parameters", $criteria_booking_status, $order_booking_status);
        
        $criteria_blocks['vchparamtype'] = "blocks";
        $order_blocks ['id'] = "id";
        $data['blocks'] = $this->utilmodel->selectByExample("parameters", $criteria_blocks, $order_blocks);
        
        $data['rooms'] = $this->roommodel->selectRoomsWithPersonInCharge();
        $this->load->view('book', $data);
    }

    public function showReservationDone() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }

        $userData = getUserSessionData();

        $request = $_REQUEST;
        $status_search = $this->input->post('status_search');
        $datetfrom_search = $this->input->post('datetfrom_search');
        $dateto_search = $this->input->post('dateto_search');
        $vchroomno = $this->input->post('vchroomno_search');

        $criteria = array();
        //Date-From search
        if (!empty($datetfrom_search)) {
            $datetfrom_search = str_replace('/', '-', $datetfrom_search);
            $datetfrom_search = date('Y-m-d', strtotime($datetfrom_search));
            $criteria['r.dtfrom'] = $datetfrom_search;
        }
        //Date-To search
        if (!empty($dateto_search)) {
            $dateto_search = str_replace('/', '-', $dateto_search);
            $dateto_search = date('Y-m-d', strtotime($dateto_search));
            $criteria['r.dtto'] = $dateto_search;
        }

        //Room search
        if (!empty($vchroomno)) {
            $criteria['ro.vchroomno'] = $vchroomno;
        }
        // Status search
        if (!empty($status_search) && $status_search != "all") {
            $criteria['rrm.vchstatus'] = $status_search;
        }
        //$criteria = "";
        $noOfRows = intval($request['length']);
        $startAt = intval($request['start']);
        $results = $this->reservemodel->get_reservation_data($startAt, $noOfRows, $criteria);
        $reservaionList = $results['queryResults'];
        $noOfRowsInResult = $results['noOfRowsInResult'];

        $json_response = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => intval($noOfRowsInResult), //count($data['rooms']),
            "recordsFiltered" => intval($noOfRowsInResult), //count($data['rooms']),
            "data" => $reservaionList
        );

        echo json_encode($json_response);
    }

    public function addNewResearvation() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $userData = getUserSessionData();

        $introomid = $this->input->post('introomid');
        $data['dtfrom'] = $this->input->post('dtfrom');
        $data['dtto'] = $this->input->post('dtto');
        $data['vchremarks'] = $this->input->post('vchremarks');
        $data['vchpurpose'] = $this->input->post('vchpurpose');
        $data['intuserid'] = $userData['userid'];
        $data['vchreservestatus'] = "P";


        $data['dtfrom'] = str_replace('-', '', $data['dtfrom']);
        $data['dtfrom'] = str_replace('/', '-', $data['dtfrom']);
        $data['dtfrom'] = date('Y-m-d H:i A', strtotime($data['dtfrom']));

        $dtfromValidation = date('Y-m-d H:i:s', strtotime($data['dtfrom']));

        $data['dtto'] = str_replace('-', '', $data['dtto']);
        $data['dtto'] = str_replace('/', '-', $data['dtto']);
        $data['dtto'] = date('Y-m-d H:i A', strtotime($data['dtto']));

        $dttoValidation = date('Y-m-d H:i:s', strtotime($data['dtto']));

        $now = date("Y-m-d H:i A");
        $data['dtcreatedate'] = $now;

        $result = $this->reservemodel->insertNewReservation($data, $introomid, $dtfromValidation, $dttoValidation);
        $json_response = array();
        if (isset($result['errorRooms'])) {
            $json_response = array('errorCode' => $result['errorCode'], 'errorDesc' => $result['errorDesc'], 'errorRooms' => $result['errorRooms']);
        } else {
            $json_response = array('errorCode' => $result['errorCode'], 'errorDesc' => $result['errorDesc']);
        }

        echo json_encode($json_response);
    }

    public function approveResearvation() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $userData = getUserSessionData();
        $userId = $userData['userid'];
        $reservationList = $this->input->post('reservationList');
        $counter = 0;
        $now = date("Y-m-d H:i A");
        $reservation = array();
        foreach ($reservationList as $value) {
            $pieces = explode(":", $value);
            $reservation[$counter]['intreserveid'] = $pieces[0];
            $reservation[$counter]['introomid'] = $pieces[1];
            $reservation[$counter]['vchstatus'] = "A";
            $reservation[$counter]['processedby'] = $userId;
            $reservation[$counter]['processdate'] = $now;
            $counter++;
        }
        $result = $this->reservemodel->approveOrRejectReservation($reservation);
        $json_response = array();
        if (isset($result['errorRooms'])) {
            $json_response = array('errorCode' => $result['errorCode'], 'errorDesc' => $result['errorDesc'], 'errorRooms' => $result['errorRooms']);
        } else {
            $json_response = array('errorCode' => $result['errorCode'], 'errorDesc' => $result['errorDesc']);
        }
        echo json_encode($json_response);
    }

    public function rejectResearvation() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $userData = getUserSessionData();
        $userId = $userData['userid'];
        $reservationList = $this->input->post('reservationList');
        $counter = 0;
        $now = date("Y-m-d H:i A");
        $reservation = array();
        foreach ($reservationList as $value) {
            $pieces = explode(":", $value);
            $reservation[$counter]['intreserveid'] = $pieces[0];
            $reservation[$counter]['introomid'] = $pieces[1];
            $reservation[$counter]['vchstatus'] = "R";
            $reservation[$counter]['processedby'] = $userId;
            $reservation[$counter]['processdate'] = $now;
            $counter++;
        }
        $result = $this->reservemodel->approveOrRejectReservation($reservation);
        $json_response = array();
        if (isset($result['errorRooms'])) {
            $json_response = array('errorCode' => $result['errorCode'], 'errorDesc' => $result['errorDesc'], 'errorRooms' => $result['errorRooms']);
        } else {
            $json_response = array('errorCode' => $result['errorCode'], 'errorDesc' => $result['errorDesc']);
        }
        echo json_encode($json_response);
    }

}
