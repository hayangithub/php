<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Roommodel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
     public function insertNewRoom($roomData) {
    //public function insertNewRoom($roomData, $userIdArray) {
        $this->db->trans_begin();

        $this->db->select('vchroomno');
        $this->db->from("rooms");
        $this->db->where('vchroomno', $roomData['vchroomno']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->trans_complete();
            return array('errorCode' => '0002', "errorDesc" => "Room No. Already Exist");
        }

        $this->db->insert("rooms", $roomData);
        $lastInsertedRoomId = $this->db->insert_id();
        //if (!is_array($userIdArray)) {
       //     $userIdArray = array($userIdArray);
        //}
        //foreach ($userIdArray as $userId) {
        //    $roomAdminData['introomid'] = $lastInsertedRoomId;
        //    $roomAdminData['intpersonincharge'] = $userId;
        //    $this->db->insert("rooms_admin", $roomAdminData);
       // }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('errorCode' => '0001', "errorDesc" => "Database Transaction Error, Please Try Again Later");
        } else {
            $this->db->trans_commit();
            return array('errorCode' => '0000', "errorDesc" => "");
        }
    }
 public function updateRoom($roomData) {
   // public function updateRoom($roomData, $userIdArray) {
        $this->db->trans_begin();

        $this->db->select('vchroomno');
        $this->db->from("rooms");
        $this->db->where('vchroomno', $roomData['vchroomno']);
        $this->db->where_not_in('introomid', $roomData['introomid']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->trans_complete();
            return array('errorCode' => '0002', "errorDesc" => "Room No. Already Exist");
        }

        $this->db->where("introomid", $roomData['introomid']);
        $this->db->update("rooms", $roomData);

        //$this->db->where('introomid', $roomData['introomid']);
        //$this->db->delete("rooms_admin");

        //if (!is_array($userIdArray)) {
        //    $userIdArray = array($userIdArray);
        //}
        //foreach ($userIdArray as $userId) {
        //    $roomAdminData['introomid'] = $roomData['introomid'];
        //    $roomAdminData['intpersonincharge'] = $userId;
        //    $this->db->insert("rooms_admin", $roomAdminData);
       // }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('errorCode' => '0001', "errorDesc" => "Database Transaction Error, Please Try Again Later");
        } else {
            $this->db->trans_commit();
            return array('errorCode' => '0000', "errorDesc" => "");
        }
    }

    public function get_rooms_data1($criteria, $startAt, $noOfRows) {
        $sql = "SELECT ro.vchroomno, 
                       ro.intcapacity,
                       p1.vchparamdesc AS vchroomtype,
                       p2.vchparamdesc AS chblock,
                       p3.vchparamdesc AS chstatus
                FROM rooms ro, parameters p1,  parameters p2,  parameters p3 WHERE
                (ro.vchroomtype=p1.vchparamcode AND p1.vchparamtype='room_type')
                AND
                (ro.chblock=p2.vchparamcode AND p2.vchparamtype='blocks')
                AND
                (ro.chstatus=p3.vchparamcode AND p3.vchparamtype='enable_flag') ";

        if ($criteria != null) {
            foreach ($criteria as $key => $value) {
                $sql .= " AND  $key = '$value' ";
            }
        }
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query1 = $this->db->query($sql);
        $result['noOfRowsInResult'] = $query1->num_rows(); // get number of roos in the results
        $sql .= "order by ro.vchroomno";
        $sql .= " LIMIT " . $startAt . " , " . $noOfRows;
        $query2 = $this->db->query($sql);
        $result['queryResults'] = $query2->result_array(); // get the data;

        return $result;
    }

    public function selectRoomsWithPIC($criteria,$criteriaManager, $startAt, $noOfRows) {
        $sql_old = "SELECT ro.introomid,
		     ro.vchroomno, 
	             ro.intcapacity,
	             p1.vchparamdesc AS vchroomtype,
	             p2.vchparamdesc AS chstatus,
	             p3.vchparamdesc AS chblock,
	             u.vchfirstname,
	             u.vchlastname,
	             ra.intpersonincharge
	             FROM rooms ro 
	             LEFT JOIN rooms_admin ra ON   (ro.introomid=ra.introomid)
	             LEFT JOIN users u ON   (u.intuserid=ra.intpersonincharge)
	             LEFT JOIN parameters p1 ON (ro.vchroomtype=p1.vchparamcode AND p1.vchparamtype='room_type')
                LEFT JOIN parameters p2 ON   (ro.chstatus=p2.vchparamcode AND p2.vchparamtype='enable_flag')
                LEFT JOIN parameters p3 ON (ro.chblock=p3.vchparamcode AND p3.vchparamtype='blocks') 
                WHERE ra.intpersonincharge IS NOT NULL ";

        $sql="SELECT ro.introomid,
		     ro.vchroomno, 
	             ro.intcapacity,
	             p1.vchparamdesc AS vchroomtype,
	             p2.vchparamdesc AS chstatus,
	             p3.vchparamdesc AS chblock,
	             CONCAT(u1.vchfirstname, ' ' ,u1.vchlastname) AS manager1,
	             CONCAT(u2.vchfirstname, ' ' ,u2.vchlastname) AS manager2
	             FROM rooms ro 
	             LEFT JOIN users u1 ON   (u1.intuserid=ro.intmanager1)
	             LEFT JOIN users u2 ON   (u2.intuserid=ro.intmanager2)
	             LEFT JOIN parameters p1 ON (ro.vchroomtype=p1.vchparamcode AND p1.vchparamtype='room_type')
                LEFT JOIN parameters p2 ON   (ro.chstatus=p2.vchparamcode AND p2.vchparamtype='enable_flag')
                LEFT JOIN parameters p3 ON (ro.chblock=p3.vchparamcode AND p3.vchparamtype='blocks') 
                WHERE ro.vchroomno IS NOT NULL ";
        
        if ($criteria != null) {
            // $key_first = array_key_first($criteria);
            //$sql .= " WHERE $key_first = '$criteria[$key_first]' ";
            //unset($criteria[$key_first]);
            foreach ($criteria as $key => $value) {
                $sql .= " AND  $key = '$value' ";
            }
        }
        if ($criteriaManager != null) {
             $userid=$criteriaManager['userid'];
            $sql .= " AND (ro.intmanager1 = '$userid' OR ro.intmanager2 = '$userid')";
        }
        $sql .= " ORDER BY ro.chblock";
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query1 = $this->db->query($sql);
        $result['noOfRowsInResult'] = $query1->num_rows(); // get number of roos in the results
       // $sql .= "order by ro.vchroomno";
        $sql .= " LIMIT " . $startAt . " , " . $noOfRows;
        $query2 = $this->db->query($sql);
        $result['queryResults'] = $query2->result_array(); // get the data;

        return $result;
    }

    public function selectPersonInChargeForSpecificRoom($introomid) {
        $sql = "SELECT intmanager1,intmanager2 FROM rooms 
                WHERE introomid='$introomid'";
        
        $query = $this->db->query($sql);
        return $query->row();
    }

    
    public function selectRoomsWithPersonInCharge() {
        $sql = "SELECT ro.vchroomno,
                ro.introomid,
                ro.chblock 
                FROM rooms ro
                WHERE ro.intmanager1 IS NOT NULL AND
                ro.chstatus='A'" ;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function selectRoomsPersonInCharge($introomid) {
        $sql_old = "SELECT 
                u.intuserid,
                u.vchfirstname,
                u.vchlastname,
                u.vchemail,
                GROUP_CONCAT(r.chblock )as chblock,
                GROUP_CONCAT(r.vchroomno )as vchroomno
                FROM rooms_admin ra 
                LEFT JOIN users u ON (u.intuserid=ra.intpersonincharge)
                LEFT JOIN rooms r ON (r.introomid=ra.introomid)
                WHERE ra.introomid IN ($introomid)
                GROUP BY u.intuserid";
        
        $sql="SELECT 
                u.intuserid,
                u.vchfirstname,
                u.vchlastname,
                u.vchemail,
                GROUP_CONCAT(ro.chblock )as chblock,
                GROUP_CONCAT(ro.vchroomno )as vchroomno
                FROM rooms ro 
                LEFT JOIN users u ON (u.intuserid=ro.intmanager1)
                WHERE ro.introomid IN ($introomid)
                GROUP BY u.intuserid";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
