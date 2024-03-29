<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin:*');

class Return_visit extends SYS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('return_visit_service');
    }

    /**
    * 获取回访计划列表
    */
    function find_return_visit_list() {
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;

        $result = $this->return_visit_service->find_return_visit_list($page, $limit);
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑回访计划
    */
    function save_return_visit() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $software_product_id = isset($_POST['add_software_product_id']) ? $_POST['add_software_product_id'] : '';
        $user_id = isset($_POST['add_user_id']) ? $_POST['add_user_id'] : '';
        $customer_user_id = isset($_POST['add_customer_user_id']) ? $_POST['add_customer_user_id'] : '';
        $return_visit_reasons = isset($_POST['return_visit_reasons']) ? $_POST['return_visit_reasons'] : '';
        $return_visit_content = isset($_POST['return_visit_content']) ? $_POST['return_visit_content'] : '';
        $return_visit_time = isset($_POST['return_visit_time']) ? $_POST['return_visit_time'] : '';

        $result = $this->return_visit_service->save_return_visit($id, $software_product_id, $user_id, $customer_user_id, $return_visit_reasons, $return_visit_content, $return_visit_time);
        echo json_encode($result);exit;
    }

    /**
    * 删除回访计划
    */
    function del_return_visit() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->return_visit_service->del_return_visit($id);
        echo json_encode($result);exit;
    }

    /**
    * 获取回访计划
    */
    function get_return_visit() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->return_visit_service->get_return_visit($id);
        echo json_encode($result);exit;
    }

}