<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function setUserSessionData($user) {
    $CI = & get_instance();
    $roleArray = explode(',', $user[0]['privilage_code']);
    $user_data = array(
    'email' => $user[0]['vchemail'],
    'firstName' => $user[0]['vchfirstname'],
    'lastName' => $user[0]['vchlastname'],
    'userid' => $user[0]['intuserid'],
    'roles' => $roleArray
    );
    $CI->session->set_userdata('userdata', $user_data);
}

function checkUserSessionData() {
    $CI = & get_instance();
    $user_data = $CI->session->userdata('userdata');
    if (!empty($user_data)) {
        return true;
    } else {
        return false;
    }
}

function getUserSessionData() {
    $CI = & get_instance();
    $user_data = $CI->session->userdata('userdata');
    if (!empty($user_data)) {
        return $user_data;
    }
}

function clearUserSessionData() {
    $CI = & get_instance();
    $user_data = $CI->session->userdata('userdata');
    return !empty($user_data);
}
