<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utilmodel');
        $this->load->model('usermodel');
    }

    public function showusers() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $criteriaUserType['vchparamtype'] = "user_type";
        $orderByUserype['vchparamcode'] = "vchparamdesc";
        $data['userypes'] = $this->utilmodel->selectByExample("parameters", $criteriaUserType, $orderByUserype);

        $criteriaEnableFlag['vchparamtype'] = "enable_flag";
        $orderByEnableFlag['vchparamcode'] = "vchparamcode";
        $data['enable_flag'] = $this->utilmodel->selectByExample("parameters", $criteriaEnableFlag, $orderByEnableFlag);

        $criteriaDepartments['vchparamtype'] = "departments";
        $orderByDepartments['vchparamcode'] = "vchparamdesc";
        $data['departments'] = $this->utilmodel->selectByExample("parameters", $criteriaDepartments, $orderByDepartments);


        $this->load->view('users', $data);
    }

    public function showUsersDone() {
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
        $results = $this->usermodel->getUsersWithRoles($startAt,$noOfRows,$criteria);
        $usersList = $results['queryResults'];
        $noOfRowsInResult = $results['noOfRowsInResult'];

        $json_response = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => intval($noOfRowsInResult), //count($data['rooms']),
            "recordsFiltered" => intval($noOfRowsInResult), //count($data['rooms']),
            "data" => $usersList
        );

        echo json_encode($json_response);
    }

    public function searchUsers() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        
        $request = $_REQUEST;
        $employeeno_search = $this->input->post('employeeno_search');
        $department_search = $this->input->post('department_search');
        $email_search = $this->input->post('email_search');
        $status_search = $this->input->post('status_search');
        
        $criteria = array();
        if ($department_search != "all") {
            $criteria['chdepartment'] = $department_search;
        }
        if ($status_search != 'all') {
            $criteria['chstatus'] = $status_search;
        }

        if ($email_search != "") {
            $criteria['vchemail'] = $email_search;
        }
        
        if ($employeeno_search != "") {
            $criteria['vchemployeeno'] = $employeeno_search;
        }
        $noOfRows = intval($request['length']);
        $startAt = intval($request['start']);
        $results = $this->usermodel->getUsersWithRoles($startAt,$noOfRows,$criteria);
        $usersList = $results['queryResults'];
        $noOfRowsInResult = $results['noOfRowsInResult'];

        $json_response = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => intval($noOfRowsInResult), //count($data['rooms']),
            "recordsFiltered" => intval($noOfRowsInResult), //count($data['rooms']),
            "data" => $usersList
        );
        echo json_encode($json_response);
    }

    public function addNewUser() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $json_response = array();
        $request = $_REQUEST;
        $formData = (array) json_decode($request['formData'], true);
        $userData['vchfirstname'] = $formData['firstNameAdd'];
        $userData['vchlastname'] = $formData['lastNameAdd'];
        $userData['vchemail'] = $formData['emailAdd'];
        $userData['chdepartment'] = $formData['departmentAdd'];
        $userData['vchphoneno'] = $formData['mobileNoAdd'];
        $userData['vchext'] = $formData['extNoAdd'];
        $userData['vchemployeeno'] = $formData['employeeNoAdd'];
        $userData['chstatus'] = $formData['statusAdd'];
        $roleArray = $formData['roleAdd'];

        if (!is_array($roleArray)) {
           $roleArray= array($formData['roleAdd']);
        }
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $config['upload_path'] = './images/user_profile';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $errorImage = array('error' => $this->upload->display_errors());
            } else {
                $data = array('image_metadata' => $this->upload->data());
                $userData['imageurl'] = "images/user_profile" . $data['image_metadata']['file_name'];
            }
        }
        if (!empty($errorImage['error'])) {
            $json_response = array('errorImage' => "yes",
                'errorImageDesc' => $errorImage['error']);
        } else {
            $result = $this->usermodel->insertUser("users", $userData, "roles", $roleArray);
            $json_response = array('errorImage' => "no",
                'result' => $result);
        }
        echo json_encode($json_response);
    }

    public function editUser() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $data['intuserid'] = $this->input->post('intuserid');
        $data['specific_user'] = $this->utilmodel->selectByPrimaryKey("users", $data);
        
        $errorCode = "";
        
        if (isset($data['specific_user']) && !empty($data['specific_user'])) {
            $errorCode = "0000"; // Successfully Inserted
        } else {
            $errorCode = "0001"; // Error in DB
        }
        
        //Get Master Data
        $criteriaBlocks['vchparamtype'] = "departments";
        $orderByBlocks['vchparamcode'] = "vchparamcode";
        $data['departments'] = $this->utilmodel->selectByExample("parameters", $criteriaBlocks, $orderByBlocks);

        $criteriaRoomType['vchparamtype'] = "user_type";
        $orderByRoomType['vchparamcode'] = "vchparamcode";
        $data['usertypes'] = $this->utilmodel->selectByExample("parameters", $criteriaRoomType, $orderByRoomType);

        $criteriaEnableFlag['vchparamtype'] = "enable_flag";
        $orderByEnableFlag['vchparamcode'] = "vchparamcode";
        $data['enable_flag'] = $this->utilmodel->selectByExample("parameters", $criteriaEnableFlag, $orderByEnableFlag);

        $criteriaRole['intuserid'] = $data['intuserid'];
        $data['roles'] = $this->utilmodel->selectByExample("roles", $criteriaRole,"");
        
        $rolesArray=array();
        
        foreach($data['roles'] as $role) {
             array_push($rolesArray, $role['vchroledesc']);
        }
            
        $json_response = array('errorCode' => $errorCode,
            'specific_user' => $data['specific_user'],
            'departments' => $data['departments'],
            'usertypes' => $data['usertypes'],
            'enable_flag' => $data['enable_flag'],
            'roles'=> $rolesArray
        );
        echo json_encode($json_response);
    }

     public function editUserDone() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $json_response = array();
        $request = $_REQUEST;
        $formData = (array) json_decode($request['formData'], true);
        $userData['intuserid'] = $formData['intuseridEdit'];       
        $userData['vchfirstname'] = $formData['firstNameEdit'];
        $userData['vchlastname'] = $formData['lastNameEdit'];
        $userData['vchemail'] = $formData['emailEdit'];
        $userData['chdepartment'] = $formData['departmentEdit'];
        $userData['vchphoneno'] = $formData['mobileNoEdit'];
        $userData['vchext'] = $formData['extNoEdit'];
        $userData['vchemployeeno'] = $formData['employeeNoEdit'];
        $userData['chstatus'] = $formData['statusEdit'];
        $roleArray = $formData['roleEdit'];

        if (!is_array($roleArray)) {
           $roleArray= array($formData['roleEdit']);
        }
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $config['upload_path'] = './images/user_profile';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $errorImage = array('error' => $this->upload->display_errors());
            } else {
                $data = array('image_metadata' => $this->upload->data());
                $userData['imageurl'] = "images/user_profile" . $data['image_metadata']['file_name'];
            }
        }
        if (!empty($errorImage['error'])) {
            $json_response = array('errorImage' => "yes",
                'errorImageDesc' => $errorImage['error']);
        } else {
            $result = $this->usermodel->updateUserDone("users", $userData, "roles", $roleArray);
            $json_response = array('errorImage' => "no",
                'result' => $result);
        }
        echo json_encode($json_response);
    }

}
