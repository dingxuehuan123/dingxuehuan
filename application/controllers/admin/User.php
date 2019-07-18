<?php

class User extends SYS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('user_service');
    }

    /**
    * 获取用户角色列表
    */
    function find_user_role_list() {
        $result = $this->user_service->user_role_list();
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑用户角色
    */
    function save_user_role() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $role_name = isset($_POST['role_name']) ? $_POST['role_name'] : '';

        $result = $this->user_service->save_user_role($id, $role_name);
        echo json_encode($result);exit;
    }

    /**
    * 删除用户角色
    */
    function del_user_role() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->user_service->del_user_role($id);
        echo json_encode($result);exit;
    }

}