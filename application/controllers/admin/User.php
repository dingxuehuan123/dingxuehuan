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

    /**
    * 获取用户列表
    */
    function find_user_list() {
        $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : '';
        $department_id = isset($_POST['department_id']) ? $_POST['department_id'] : '';
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $per_page = isset($_POST['per_page']) ? $_POST['per_page'] : 20;

        $result = $this->user_service->find_user_list($role_id, $department_id, $keyword, $page, $per_page);
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑用户
    */
    function save_user() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : '';
        $department_id = isset($_POST['department_id']) ? $_POST['department_id'] : '';
        $job_num = isset($_POST['job_num']) ? $_POST['job_num'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';

        $result = $this->user_service->save_user($id, $role_id, $department_id, $job_num, $name, $mobile);
        echo json_encode($result);exit;
    }

    /**
    * 删除用户角色
    */
    function del_user() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->user_service->del_user($id);
        echo json_encode($result);exit;
    }

}