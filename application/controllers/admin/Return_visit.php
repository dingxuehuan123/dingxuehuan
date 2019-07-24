<?php

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
        $per_page = isset($_POST['per_page']) ? $_POST['per_page'] : 20;

        $result = $this->return_visit_service->find_return_visit_list($page, $per_page);
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑回访计划
    */
    function save_return_visit() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $feedback_id = isset($_POST['feedback_id']) ? $_POST['feedback_id'] : '';
        $customer_service_id = isset($_POST['customer_service_id']) ? $_POST['customer_service_id'] : '';
        $customer_user_id = isset($_POST['customer_user_id']) ? $_POST['customer_user_id'] : '';
        $return_visit_reasons = isset($_POST['return_visit_reasons']) ? $_POST['return_visit_reasons'] : '';
        $return_visit_content = isset($_POST['return_visit_content']) ? $_POST['return_visit_content'] : '';
        $return_visit_time = isset($_POST['return_visit_time']) ? $_POST['return_visit_time'] : '';

        $result = $this->return_visit_service->save_return_visit($id, $feedback_id, $customer_service_id, $customer_user_id, $return_visit_reasons, $return_visit_content, $return_visit_time);
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