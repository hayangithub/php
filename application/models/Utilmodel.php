<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Utilmodel extends CI_Model
{

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getParam($paramtype)
    {
        $this->db->select('*');
        $this->db->from('parameters');
        $this->db->where('vchparametertype', $paramtype);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
            //foreach ($query->result() as $data)
            //   {
            //     $param[] = $data;
            //   }
            //     return $param;
        }
    }

    public function selectByExample($tablename, $criteria, $order_by)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        if ($criteria != null) {
            foreach ($criteria as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if ($order_by != null) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function selectByPrimaryKey($tablename, $id)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        $key = array_keys($id);
        $this->db->where($key[0], $id[$key[0]]);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0];
    }

    public function countByExample($tablename, $criteria)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        foreach ($criteria as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        $result = $query->result();
        return sizeof($result);
    }

    public function deleteByPrimaryKey($tablename, $id)
    {
        $key = array_keys($id);
        $this->db->where($key[0], $id[$key[0]]);
        $result = $this->db->delete($tablename);
        return $result;
    }

    public function updateByPrimaryKey($tablename, $id, $data)
    {
        $key = array_keys($id);
        $this->db->where($key[0], $id[$key[0]]);
        $result = $this->db->update($tablename, $data);
        return $result;
    }

    public function insert($tablename, $data)
    {
        $this->db->trans_start();
        $this->db->insert($tablename, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return false;
        } else {
            return true;
        }
    }

    public function insertCSV($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }

    public function get_image_url($type = '', $id = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg')) {
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        } else {
            $image_url = base_url() . 'uploads/user.jpg';
        }

        return $image_url;
    }

  
    public function get_rooms_data($criteria, $l)
    {
        $sql = "SELECT ro.vchroomno, ro.intcapacity,
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
        $sql .= "order by ro.vchroomno";
        
        $sql .= " LIMIT " . $l;
        
        $query = $this->db->query($sql);
        return $query->result_array();
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
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}