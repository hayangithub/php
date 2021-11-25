<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utilmodel');
        $this->load->model('usermodel');
    }

    public function index() {
        $this->load->view('login');
    }

    public function test() {
        $this->load->view('test_table');
    }

    // public function dashboard() {
    //     $this->load->view('index');
    // }

    public function create() {
        $this->load->view('create1');
    }

    public function dologin() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $results = $this->usermodel->getLoginUsersWithRoles($username,$password);     
        $user = $results['queryResults'];
        
        $errorCode = "";
        if (isset($user) && count($user)==1) {
            setUserSessionData($user);
            $errorCode = "0000"; // Successfully Inserted
        } else {
            $errorCode = "0001"; // Error in DB
        }

        $json_response = array('errorCode' => $errorCode);
        echo json_encode($json_response);
    }

    public function doLogout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function dashboard() {
        if (checkUserSessionData() == false) {
            redirect(base_url());
        }
        $this->load->view('dashboard');
    }

}
