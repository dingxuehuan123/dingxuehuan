<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin:*');

class Member extends SYS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('member_service');
    }

    /**
    * 获取所有前台用户
    */
    function find_all_member() {
        $result = $this->member_service->find_all_member();
        echo json_encode($result);exit;
    }

}