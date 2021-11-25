<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usermodel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_user_data($criteria) {
        $sql = "SELECT u.intuserid,
                u.vchfirstname,
                u.vchlastname,
                u.vchemail,
                p2.vchparamdesc AS chstatus,
                p1.vchparamdesc AS chdepartment,
                u.vchphoneno,
                u.vchext
                FROM users u, parameters p1, parameters p2 WHERE
                (p1.vchparamcode=u.chdepartment AND p1.vchparamtype='departments') AND
                (p2.vchparamcode=u.chstatus AND p2.vchparamtype='enable_flag') ";
        if ($criteria != null) {
            foreach ($criteria as $key => $value) {
                $sql .= " AND  $key = '$value' ";
            }
        }
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getUsersWithRoles($startAt, $noOfRows, $criteria) {
        $sql = "SELECT  u.intuserid,
                u.vchfirstname,
                u.vchlastname,
                u.vchemail,
                u.vchemployeeno,
                u.chstatus AS status,
                p2.vchparamdesc AS chstatus,
                p3.vchparamdesc AS chdepartment,
                u.vchphoneno,
                u.vchext,
                GROUP_CONCAT(r.vchroledesc ORDER BY r.vchroledesc) AS privilage_code,
                GROUP_CONCAT(p1.vchparamdesc ORDER BY p1.vchparamdesc) AS privilage_desc
                    FROM  users u
                       LEFT JOIN roles r ON u.intuserid = r.intuserid
                       LEFT JOIN parameters p1 ON (p1.vchparamcode= r.vchroledesc AND p1.vchparamtype='user_type')
                       LEFT JOIN parameters p2 ON   (u.chstatus=p2.vchparamcode AND p2.vchparamtype='enable_flag')
                       LEFT JOIN parameters p3 ON (u.chdepartment=p3.vchparamcode AND p3.vchparamtype='departments')
                    ";
       
        if ($criteria != null) {          
                $key_first=array_key_first($criteria);
                $sql .=" WHERE $key_first = '$criteria[$key_first]' ";
                unset($criteria[$key_first]);
            foreach ($criteria as $key => $value) {
                $sql .= " AND  $key = '$value' ";
            }
        }
    $sql .= "GROUP BY (u.intuserid)";
    $this->db->query('SET SQL_BIG_SELECTS=1');
        $query1 = $this->db->query($sql);
        $result['noOfRowsInResult'] = $query1->num_rows(); // get number of roos in the results
        
        $sql .= " LIMIT " . $startAt . " , " . $noOfRows;
        $query2 = $this->db->query($sql);
        $result['queryResults'] = $query2->result_array();


        return $result;
    }

    
    public function getLoginUsersWithRoles($email,$password) {
        $sql = "SELECT  u.intuserid,
                u.vchfirstname,
                u.vchlastname,
                u.vchemail,
                u.vchpassword,
                u.vchemployeeno,
                u.chstatus,
                chdepartment,
                u.vchphoneno,
                u.vchext,
                GROUP_CONCAT(r.vchroledesc ORDER BY r.vchroledesc) AS privilage_code,
                GROUP_CONCAT(p1.vchparamdesc ORDER BY p1.vchparamdesc) AS privilage_desc
                    FROM  users u
                       LEFT JOIN roles r ON u.intuserid = r.intuserid
                       LEFT JOIN parameters p1 ON (p1.vchparamcode= r.vchroledesc AND p1.vchparamtype='user_type')
                    ";
                $sql .=" WHERE u.vchemail = '$email' AND u.chstatus='A'";
               // $sql .= " AND  u.vchpassword = '$password' ";
                $sql .= "GROUP BY (u.intuserid)";  
                $this->db->query('SET SQL_BIG_SELECTS=1');
        $query2 = $this->db->query($sql);
        $result['queryResults'] = $query2->result_array();
        return $result;
    }
    
    
    public function insertUser($userTable, $userData, $roleTable, $roleArray) {
        $this->db->trans_start();

        $this->db->select('vchemail');
        $this->db->from('users');
        $this->db->where('vchemail', $userData['vchemail']);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $this->db->trans_complete();
            return array('errorCode' => '0002', "errorDesc" => "Email Already Exist");
        }
        $this->db->insert($userTable, $userData);
        $userID = $this->db->insert_id();

        foreach ($roleArray as $role) {
            $roleData['vchroledesc'] = $role;
            $roleData['intuserid'] = $userID;
            $this->db->insert($roleTable, $roleData);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return array('errorCode' => '0001', "errorDesc" => "Error in Insert Record");
        } else {
            return array('errorCode' => '0000', "errorDesc" => "");
        }
    }

    public function updateUserDone($userTable, $userData, $roleTable, $roleArray) {
        $this->db->trans_start();
        $this->db->where('intuserid', $userData['intuserid']);
        $this->db->delete($roleTable);
        $this->db->select('vchemail');
        $this->db->from($userTable);
        $this->db->where('vchemail', $userData['vchemail']);
        $this->db->where_not_in('intuserid',$userData['intuserid']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->trans_complete();
            return array('errorCode' => '0002', "errorDesc" => "Email Already Exist");
        }

        $this->db->where('intuserid', $userData['intuserid']);
        $result = $this->db->update($userTable, $userData);

        foreach ($roleArray as $role) {
            $roleData['vchroledesc'] = $role;
            $roleData['intuserid'] = $userData['intuserid'];
            $this->db->insert($roleTable, $roleData);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return array('errorCode' => '0001', "errorDesc" => "Error in Insert Record");
        } else {
            return array('errorCode' => '0000', "errorDesc" => "");
        }
    }
    
    public function getUserBasedOnRole($criteria) {
        $sql = "SELECT u.* FROM users u, roles r WHERE u.intuserid=r.intuserid AND r.vchroledesc = '$criteria' order by u.vchfirstname";       
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
}
