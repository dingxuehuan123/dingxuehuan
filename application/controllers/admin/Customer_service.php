<?php

class Customer_service extends SYS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('customer_service_service');
    }

    /**
    * 获取客服台账列表
    */
    function find_customer_service_list() {
        $software_product_id = isset($_POST['software_product_id']) ? $_POST['software_product_id'] : '';
        $feedback_content = isset($_POST['feedback_content']) ? $_POST['feedback_content'] : '';
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $per_page = isset($_POST['per_page']) ? $_POST['per_page'] : 20;

        $result = $this->customer_service_service->find_customer_service_list($software_product_id, $feedback_content, $page, $per_page);
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑客服台账
    */
    function save_customer_service() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $software_product_id = isset($_POST['software_product_id']) ? $_POST['software_product_id'] : '';
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $customer_user_id = isset($_POST['customer_user_id']) ? $_POST['customer_user_id'] : '';
        $responsible_user_id = isset($_POST['responsible_user_id']) ? $_POST['responsible_user_id'] : '';
        $feedback_content = isset($_POST['feedback_content']) ? $_POST['feedback_content'] : '';
        $feedback_date = isset($_POST['feedback_date']) ? $_POST['feedback_date'] : '';
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $image_urls = isset($_POST['image_urls']) ? $_POST['image_urls'] : '';
        $call_time = isset($_POST['call_time']) ? $_POST['call_time'] : '';
        $talk_time = isset($_POST['talk_time']) ? $_POST['talk_time'] : '';

        $result = $this->customer_service_service->save_customer_service($id, $software_product_id, $user_id, $customer_user_id, $responsible_user_id, $feedback_content, $feedback_date, $mobile, $image_urls, $call_time, $talk_time);
        echo json_encode($result);exit;
    }

    /**
    * 删除客服台账
    */
    function del_customer_service() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->customer_service_service->del_customer_service($id);
        echo json_encode($result);exit;
    }

    /**
    * 获取客服台账
    */
    function get_customer_service() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->customer_service_service->get_customer_service($id);
        echo json_encode($result);exit;
    }

}