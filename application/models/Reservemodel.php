<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reservemodel extends CI_Model {

    public function __construct() {
// Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function dateTimeValidation($startDateTime, $endDateTime, $rooms) {
        $sql1 = "SELECT ro.vchroomno,  
            DATE_FORMAT(r.dtfrom, '%d/%m/%Y  %h:%i %p') AS dtfrom, 
            DATE_FORMAT(r.dtto, '%d/%m/%Y  %h:%i %p') AS  dtto 
             from rooms ro, reservation_rooms_map rrm, reservations r
             WHERE rrm.introomid IN ($rooms) AND rrm.introomid=ro.introomid AND rrm.intreserveid=r.intreserveid
        AND
        (((r.dtfrom >= '$startDateTime' AND r.dtfrom <= '$endDateTime') OR (r.dtto >= '$startDateTime' AND r.dtto <= '$endDateTime'))
            OR
        (('$startDateTime' >= r.dtfrom AND '$startDateTime' < r.dtto) AND  ('$endDateTime' >= r.dtfrom AND '$endDateTime' <= r.dtto)))     
         ";


        $sql = "SELECT ro.vchroomno,  
            r.dtfrom, 
            r.dtto 
            from rooms ro, reservation_rooms_map rrm, reservations r
            WHERE rrm.introomid IN ($rooms) AND rrm.introomid=ro.introomid AND rrm.intreserveid=r.intreserveid AND rrm.vchstatus in ('A','P')
            AND
            -- CASE1 :Start Datetime between dtfrom and dtto
            ((('$startDateTime' >= r.dtfrom AND '$startDateTime' < r.dtto) OR
            -- CASE2 :END Datetime between dtfrom and dtto
            ('$endDateTime' > r.dtfrom AND '$endDateTime' <= r.dtto)) 
            OR
            -- CASE3 :dtfrom between Start Datetime and End Datetime
            ((r.dtfrom >= '$startDateTime'  AND r.dtfrom < '$endDateTime') OR
            -- CASE4 :dtto between Start Datetime and End Datetime
            (r.dtto > '$startDateTime'  AND r.dtto < '$endDateTime')))
            ";

        $sql .= "GROUP BY (rrm.intreserveid)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dtFromOrDtToBetween($startDateTime, $endDateTime, $rooms) {
        $sql = "SELECT ro.vchroomno,  
            DATE_FORMAT(r.dtfrom, '%d/%m/%Y  %h:%i %p') AS dtfrom, 
            DATE_FORMAT(r.dtto, '%d/%m/%Y  %h:%i %p') AS  dtto 
             from rooms ro, reservation_rooms_map rrm, reservations r
        WHERE rrm.introomid IN ($rooms) AND rrm.introomid=ro.introomid AND rrm.intreserveid=r.intreserveid
        AND
        ((r.dtfrom >= '$startDateTime' AND r.dtfrom <= '$endDateTime') OR (r.dtto >= '$startDateTime' AND r.dtto <= '$endDateTime'))
            OR
        (('$startDateTime' >= r.dtfrom AND '$startDateTime' <= r.dtto) AND  ('$endDateTime' >= r.dtfrom AND '$endDateTime' <= r.dtto))     
         ";
        $sql .= "GROUP BY (rrm.intreserveid)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function startDtOrEndDtBetween($startDateTime, $endDateTime, $rooms) {
        $sql = "SELECT ro.vchroomno, 
            DATE_FORMAT(r.dtfrom, '%d/%m/%Y  %h:%i %p') AS dtfrom, 
            DATE_FORMAT(r.dtto, '%d/%m/%Y  %h:%i %p') AS  dtto
            from rooms ro, reservation_rooms_map rrm, reservations r
                WHERE rrm.introomid IN ($rooms) 
                    AND rrm.introomid=ro.introomid
                AND rrm.intreserveid=r.intreserveid
                AND
               (('$startDateTime' >= r.dtfrom AND '$startDateTime' <= r.dtto) AND  ('$endDateTime' >= r.dtfrom AND '$endDateTime' <= r.dtto)) ";
        $sql .= "GROUP BY (rrm.intreserveid)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_reservation_data($startAt, $noOfRows, $criteria) {
        $sql = "SELECT u.vchfirstname AS vchfirstname,
            u.vchlastname AS vchlastname ,          
            p1.vchparamdesc AS vchstatus ,
            p2.vchparamdesc AS vchpurpose ,
            DATE_FORMAT(r.dtfrom, '%d/%m/%Y  %h:%i %p') AS dtfrom,
            DATE_FORMAT(r.dtto, '%d/%m/%Y  %h:%i %p') AS dtto,
            r.intreserveid AS intreserveid,
            GROUP_CONCAT(ro.vchroomno) AS rooms
             FROM reservations r
             LEFT JOIN parameters p1 ON (p1.vchparamcode= r.vchreservestatus AND p1.vchparamtype='booking_status')
             LEFT JOIN parameters p2 ON (p2.vchparamcode= r.vchpurpose AND p2.vchparamtype='reserve_purpose')
             LEFT JOIN users u ON (r.intuserid=u.intuserid)
             LEFT JOIN reservation_rooms_map rrm ON (rrm.intreserveid=r.intreserveid)
             LEFT JOIN rooms ro ON (ro.introomid=rrm.introomid)";

        $sql2 = "SELECT u.vchfirstname AS vchfirstname,
            u.vchlastname AS vchlastname , 
				u.intuserid,         
            p1.vchparamdesc AS vchstatus ,
            p2.vchparamdesc AS vchpurpose ,
            DATE_FORMAT(r.dtfrom, '%d/%m/%Y  %h:%i %p') AS dtfrom,
            DATE_FORMAT(r.dtto, '%d/%m/%Y  %h:%i %p') AS dtto,
            r.intreserveid AS intreserveid,
            ro.vchroomno,
            road.introomid,
            road.intpersonincharge
             FROM reservations r
             LEFT JOIN parameters p1 ON (p1.vchparamcode= r.vchreservestatus AND p1.vchparamtype='booking_status')
             LEFT JOIN parameters p2 ON (p2.vchparamcode= r.vchpurpose AND p2.vchparamtype='reserve_purpose')
             LEFT JOIN users u ON (r.intuserid=u.intuserid)
             LEFT JOIN reservation_rooms_map rrm ON (rrm.intreserveid=r.intreserveid)
             LEFT JOIN rooms ro ON (ro.introomid=rrm.introomid)
             LEFT JOIN rooms_admin road ON (road.introomid=ro.introomid)";


        $sql1_old = "SELECT u.vchfirstname AS vchfirstname,
            u.vchlastname AS vchlastname , 
				u.intuserid,         
            p2.vchparamdesc AS vchpurpose ,
            DATE_FORMAT(r.dtfrom, '%d/%m/%Y  %h:%i %p') AS dtfrom,
            DATE_FORMAT(r.dtto, '%d/%m/%Y  %h:%i %p') AS dtto,
            r.intreserveid AS intreserveid,
            rrm.vchstatus,
            p1.vchparamdesc AS vchStatusDesc ,
            ro.vchroomno,
            road.introomid,
            road.intpersonincharge
             FROM reservations r
             LEFT JOIN reservation_rooms_map rrm ON (rrm.intreserveid=r.intreserveid)
             LEFT JOIN parameters p1 ON (p1.vchparamcode= rrm.vchstatus AND p1.vchparamtype='booking_status')
             LEFT JOIN parameters p2 ON (p2.vchparamcode= r.vchpurpose AND p2.vchparamtype='reserve_purpose')
             LEFT JOIN users u ON (r.intuserid=u.intuserid)            
             LEFT JOIN rooms ro ON (ro.introomid=rrm.introomid)
             LEFT JOIN rooms_admin road ON (road.introomid=ro.introomid)
             WHERE road.introomid IS NOT NULL ";


        $sql1 = "SELECT u.vchfirstname AS vchfirstname,
            u.vchlastname AS vchlastname , 
				u.intuserid,         
            p2.vchparamdesc AS vchpurpose ,
            DATE_FORMAT(r.dtfrom, '%d/%m/%Y  %h:%i %p') AS dtfrom,
            DATE_FORMAT(r.dtto, '%d/%m/%Y  %h:%i %p') AS dtto,
            r.intreserveid AS intreserveid,
            rrm.vchstatus,
            p1.vchparamdesc AS vchStatusDesc ,
            ro.introomid,
            ro.vchroomno,
            ro.intmanager1,
            ro.intmanager2
             FROM reservations r
             LEFT JOIN reservation_rooms_map rrm ON (rrm.intreserveid=r.intreserveid)
             LEFT JOIN parameters p1 ON (p1.vchparamcode= rrm.vchstatus AND p1.vchparamtype='booking_status')
             LEFT JOIN parameters p2 ON (p2.vchparamcode= r.vchpurpose AND p2.vchparamtype='reserve_purpose')
             LEFT JOIN users u ON (r.intuserid=u.intuserid)            
             LEFT JOIN rooms ro ON (ro.introomid=rrm.introomid)
             WHERE r.intreserveid IS NOT NULL ";


        if (isset($criteria['r.dtfrom']) && isset($criteria['r.dtto'])) {
            $dtfrom = $criteria['r.dtfrom'];
            $dtto = $criteria['r.dtto'];
            $sql1 .= "AND  (r.dtfrom >= '$dtfrom' AND r.dtto <= '$dtto')";
        }

        if (isset($criteria['ro.vchroomno'])) {
            $vchroomno = $criteria['ro.vchroomno'];
            $sql1 .= "AND  ro.vchroomno='$vchroomno'";
        }

        if (isset($criteria['rrm.vchstatus'])) {
            $vchstatus = $criteria['rrm.vchstatus'];
            $sql1 .= "AND  rrm.vchstatus='$vchstatus'";
        }

       // if (isset($criteria['road.intpersonincharge'])) {
       //     $intpersonincharge = $criteria['road.intpersonincharge'];
       //     $sql1 .= "AND  road.intpersonincharge='$intpersonincharge'";
       // }
        if (isset($criteria['managerid'])) {
            $managerid = $criteria['managerid'];
            $sql1 .= "AND  (ro.intmanager1=$managerid OR ro.intmanager2=$managerid)";
        }
        if (isset($criteria['r.intuserid'])) {
            $intreserveid = $criteria['r.intuserid'];
            $sql1 .= "AND  r.intuserid='$intreserveid'";
        }

        // $sql .= "GROUP BY (r.intreserveid)";

        $sql1 .= "ORDER BY (r.intreserveid) desc";
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query1 = $this->db->query($sql1);
        $result['noOfRowsInResult'] = $query1->num_rows(); // get number of roos in the results

        $sql1 .= " LIMIT " . $startAt . " , " . $noOfRows;
        $query2 = $this->db->query($sql1);
        $result['queryResults'] = $query2->result_array();


        return $result;
    }

    public function insertNewReservation($reservationData, $roomsIdArray, $dtfromValidation, $dttoValidation) {
        $this->db->trans_begin();
        $comma_separated = "";
        if (is_array($roomsIdArray)) {
            $comma_separated = implode(",", $roomsIdArray);
        } else {
            $comma_separated = $roomsIdArray;
        }

        $result = $this->dateTimeValidation($dtfromValidation, $dttoValidation, $comma_separated);
        if (count($result) > 0) {
            $this->db->trans_complete();
            return array('errorCode' => '0002', 'errorDesc' => "", 'errorRooms' => $result);
        }
        $this->db->insert("reservations", $reservationData);

        $lastInsertedRoomId = $this->db->insert_id();
        if (!is_array($roomsIdArray)) {
            $roomsIdArray = array($roomsIdArray);
        }
        foreach ($roomsIdArray as $roomId) {
            $roomReservationData['intreserveid'] = $lastInsertedRoomId;
            $roomReservationData['introomid'] = $roomId;
            $roomReservationData['vchstatus'] = "P";
            $this->db->insert("reservation_rooms_map", $roomReservationData);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('errorCode' => '0001', "errorDesc" => "Database Transaction Error, Please Try Again Later");
        } else {
            $this->db->trans_commit();
            return array('errorCode' => '0000', "errorDesc" => "");
        }
    }

    public function approveOrRejectReservation($reservationList) {
        $this->db->trans_begin();


        foreach ($reservationList as $reservation) {
            $data['vchstatus'] = $reservation['vchstatus'];
            $data['processedby'] = $reservation['processedby'];
            $data['processdate'] = $reservation['processdate'];
            ;
            $this->db->where("intreserveid", $reservation['intreserveid']);
            $this->db->where("introomid", $reservation['introomid']);
            $this->db->update("reservation_rooms_map", $data);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('errorCode' => '0001', "errorDesc" => "Database Transaction Error, Please Try Again Later");
        } else {
            $this->db->trans_commit();
            return array('errorCode' => '0000', "errorDesc" => "");
        }
    }

}
