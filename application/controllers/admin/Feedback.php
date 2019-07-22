<?php

class Feedback extends SYS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('feedback_service');
    }

    /**
    * 获取反馈列表
    */
    function find_feedback_list() {
        $software_product_id = isset($_POST['software_product_id']) ? $_POST['software_product_id'] : '';
        $problem_cate_id = isset($_POST['problem_cate_id']) ? $_POST['problem_cate_id'] : '';
        $feedback_content = isset($_POST['feedback_content']) ? $_POST['feedback_content'] : '';
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $per_page = isset($_POST['per_page']) ? $_POST['per_page'] : 20;

        $result = $this->feedback_service->find_feedback_list($software_product_id, $problem_cate_id, $feedback_content, $page, $per_page);
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑反馈
    */
    function save_feedback() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $software_product_id = isset($_POST['software_product_id']) ? $_POST['software_product_id'] : '';
        $problem_cate_id = isset($_POST['problem_cate_id']) ? $_POST['problem_cate_id'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $feedback_content = isset($_POST['feedback_content']) ? $_POST['feedback_content'] : '';
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $image_urls = isset($_POST['image_urls']) ? $_POST['image_urls'] : '';
        $audio_url = isset($_POST['audio_url']) ? $_POST['audio_url'] : '';
        $urgent = isset($_POST['urgent']) ? $_POST['urgent'] : '';

        $result = $this->feedback_service->save_feedback($id, $software_product_id, $problem_cate_id, $name, $feedback_content, $mobile, $image_urls, $audio_url, $urgent);
        echo json_encode($result);exit;
    }

    /**
    * 删除反馈
    */
    function del_feedback() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->feedback_service->del_feedback($id);
        echo json_encode($result);exit;
    }

    /**
    * 获取反馈
    */
    function get_feedback() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->feedback_service->get_feedback($id);
        echo json_encode($result);exit;
    }

    /**
    * 开始处理
    */
    function status() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->feedback_service->status($id);
        echo json_encode($result);exit;
    }

    /**
    * 提交结果
    */
    function feedback_result() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $feedback_result = isset($_POST['feedback_result']) ? $_POST['feedback_result'] : '';

        $result = $this->feedback_service->feedback_result($feedback_result);
        echo json_encode($result);exit;
    }

}