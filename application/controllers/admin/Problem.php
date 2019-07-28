<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin:*');

class Problem extends SYS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('problem_service');
    }

    /**
    * 获取问题类型列表
    */
    function find_problem_cate_list() {
        $cate_name = isset($_POST['cate_name']) ? $_POST['cate_name'] : '';
        $result = $this->problem_service->find_problem_cate_list($cate_name);
        echo json_encode($result);exit;
    }

    /**
    * 新增问题类型角色
    */
    function save_problem_cate() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $cate_name = isset($_POST['cate_name']) ? $_POST['cate_name'] : '';
        $sub_cate_name = isset($_POST['sub_cate_name']) ? $_POST['sub_cate_name'] : '';

        $result = $this->problem_service->save_problem_cate($id, $cate_name, $sub_cate_name);
        echo json_encode($result);exit;
    }

    /**
    * 删除问题类型
    */
    function del_problem_cate() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->problem_service->del_problem_cate($id);
        echo json_encode($result);exit;
    }

    /**
    * 获取问题列表
    */
    function find_problem_list() {
        $problem_cate_id = isset($_POST['problem_cate_id']) ? $_POST['problem_cate_id'] : '';
        $problem = isset($_POST['problem']) ? $_POST['problem'] : '';
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;

        $result = $this->problem_service->find_problem_list($problem_cate_id, $problem, $page, $limit);
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑问题
    */
    function save_problem() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $problem_cate_id = isset($_POST['add_problem_cate_id']) ? $_POST['add_problem_cate_id'] : '';
        $problem = isset($_POST['problem']) ? $_POST['problem'] : '';
        $answer = isset($_POST['answer']) ? $_POST['answer'] : '';

        $result = $this->problem_service->save_problem($id, $problem_cate_id, $problem, $answer);
        echo json_encode($result);exit;
    }

    /**
    * 删除问题
    */
    function del_problem() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->problem_service->del_problem($id);
        echo json_encode($result);exit;
    }

}