<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class rooms extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utilmodel');
        $this->load->model('usermodel');
        $this->load->model('roommodel');
    }

    /* -------------Start-  Initail Function to load room list page----------------- */

    public function showrooms() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $criteriaBlocks['vchparamtype'] = "blocks";
        $orderByBlocks['vchparamcode'] = "vchparamcode";
        $data['blocks'] = $this->utilmodel->selectByExample("parameters", $criteriaBlocks, $orderByBlocks);
        $criteriaRoomType['vchparamtype'] = "room_type";
        $orderByRoomType['vchparamcode'] = "vchparamcode";
        $data['roomtypes'] = $this->utilmodel->selectByExample("parameters", $criteriaRoomType, $orderByRoomType);

        $data['users'] = $this->usermodel->getUserBasedOnRole("MA");



        $this->load->view('rooms_list', $data);
    }

    /* -------------End-  Initail Function to load room list page----------------- */




    /* -------------Start-  Search Rooms Done----------------- */

    public function showRoomsDone() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $request = $_REQUEST;
        $chblock = $this->input->post('chblock_search');
        $vchroomtype = $this->input->post('vchroomtype_search');
        $vchroomno = $this->input->post('vchroomno_search');
        $criteria = array();
        if (isset($chblock) && $chblock != "all") {
            $criteria['chblock'] = $chblock;
        }
        if (isset($vchroomtype) && $vchroomtype != 'all') {
            $criteria['vchroomtype'] = $vchroomtype;
        }
        if ($vchroomno != "") {
            $criteria['vchroomno'] = $vchroomno;
        }
        //$criteria = "";
        $noOfRows = intval($request['length']);
        $startAt = intval($request['start']);
        $results = $this->roommodel->selectRoomsWithPIC($criteria, $startAt, $noOfRows);
        $roomsList = $results['queryResults'];
        $noOfRowsInResult = $results['noOfRowsInResult'];

        $json_response = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => intval($noOfRowsInResult), //count($data['rooms']),
            "recordsFiltered" => intval($noOfRowsInResult), //count($data['rooms']),
            "data" => $roomsList
        );
        echo json_encode($json_response);
    }

    /* -------------End-  Search Rooms Done----------------- */

    public function addnewroom() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $roomData['vchroomno'] = $this->input->post('vchroomno');
        $roomData['vchroomtype'] = $this->input->post('vchroomtype');
        $roomData['chblock'] = $this->input->post('chblock');
        $roomData['intcapacity'] = (int) $this->input->post('capacity');
        $roomData['chstatus'] = $this->input->post('status');     
        $intuserid = $this->input->post('intuserid');

        $result = $this->roommodel->insertNewRoom($roomData,$intuserid);
        $json_response = array('errorCode' =>$result['errorCode'], 'errorDesc'=> $result['errorDesc']);

        echo json_encode($json_response);
    }

    public function edit_room() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $data['introomid'] = $this->input->post('introomid');

        $data['specific_room'] = $this->utilmodel->selectByPrimaryKey("rooms", $data);
        $errorCode = "";
        if (isset($data['specific_room']) && !empty($data['specific_room'])) {
            $errorCode = "0000"; // Successfully Inserted
        } else {
            $errorCode = "0001"; // Error in DB
        }
        $criteriaBlocks['vchparamtype'] = "blocks";
        $orderByBlocks['vchparamcode'] = "vchparamcode";
        $data['blocks'] = $this->utilmodel->selectByExample("parameters", $criteriaBlocks, $orderByBlocks);

        $criteriaRoomType['vchparamtype'] = "room_type";
        $orderByRoomType['vchparamcode'] = "vchparamcode";
        $data['roomtypes'] = $this->utilmodel->selectByExample("parameters", $criteriaRoomType, $orderByRoomType);

        $criteriaEnableFlag['vchparamtype'] = "enable_flag";
        $orderByEnableFlag['vchparamcode'] = "vchparamcode";
        $data['enable_flag'] = $this->utilmodel->selectByExample("parameters", $criteriaEnableFlag, $orderByEnableFlag);

        $criteriaPersonInCharge['introomid'] = $data['specific_room']['introomid'];
        $data['pic'] = $this->utilmodel->selectByExample("rooms_admin", $criteriaPersonInCharge, "");

        
         $picArray=array();
        
        foreach($data['pic'] as $pic) {
             array_push($picArray, $pic['intpersonincharge']);
        }
        
        
        $json_response = array('errorCode' => $errorCode,
            'specific_room' => $data['specific_room'],
            'blocks' => $data['blocks'],
            'roomtypes' => $data['roomtypes'],
            'enable_flag' => $data['enable_flag'],
            'pic'=>  $picArray
        );
        echo json_encode($json_response);
    }

    public function editRoomDone() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $roomData['chblock'] = $this->input->post('chblock');
        $roomData['vchroomtype'] = $this->input->post('vchroomtype');
        $roomData['vchroomno'] = $this->input->post('vchroomno');
        $roomData['intcapacity'] = $this->input->post('capacity');
        $roomData['chstatus'] = $this->input->post('status');
        $roomData['introomid'] = $this->input->post('introomid');
        $intuserid = $this->input->post('intuserid');
        $result = $this->roommodel->updateRoom($roomData,$intuserid);
        $json_response = array('errorCode' =>$result['errorCode'], 'errorDesc'=> $result['errorDesc']);
        echo json_encode($json_response);
    }

    // Commented Code 
    /*
      public function searchrooms() {
      if (checkUserSessionData() == false) {
      redirect(base_url());
      }
      $chblock = $this->input->post('chblock_search');
      $vchroomtype = $this->input->post('vchroomtype_search');
      $vchroomno = $this->input->post('vchroomno_search');
      $criteria = array();
      if ($chblock != "all") {
      $criteria['chblock'] = $chblock;
      }
      if ($vchroomtype != 'all') {
      $criteria['vchroomtype'] = $vchroomtype;
      }

      if ($vchroomno != "") {
      $criteria['vchroomno'] = $vchroomno;
      }
      $data['rooms'] = $this->utilmodel->get_rooms_data($criteria,4);
      $json_response = array('rooms_list' => $data['rooms']);
      echo json_encode($json_response);
      }

     */
}
