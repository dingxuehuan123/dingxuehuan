<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin:*');

class Software_product extends SYS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('software_product_service');
    }

    /**
    * 获取软件产品列表
    */
    function find_software_product_list() {
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;

        $result = $this->software_product_service->find_software_product_list($product_name, $page, $limit);
        echo json_encode($result);exit;
    }

    /**
    * 新增编辑软件产品
    */
    function save_software_product() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
        $banner_url = isset($_POST['banner_url']) ? $_POST['banner_url'] : '';
        $intro = isset($_POST['intro']) ? $_POST['intro'] : '';
        $attachment_url = isset($_POST['attachment_url']) ? $_POST['attachment_url'] : '';

        $result = $this->software_product_service->save_software_product($id, $product_name, $banner_url, $intro, $attachment_url);
        echo json_encode($result);exit;
    }

    /**
    * 删除软件产品
    */
    function del_software_product() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $result = $this->software_product_service->software_product_model($id);
        echo json_encode($result);exit;
    }

}