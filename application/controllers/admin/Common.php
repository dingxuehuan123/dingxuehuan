<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin:*');

class Common extends SYS_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
    * 文件上传
    */
    function upload_file(){
        $data = $this->get_file("file");
        if(empty($data)){
            echo json_encode(output(1001,'请选择文件'));
        }

        if(isset($data['file_name'])){
            $image = $this->config->item('domain_www').'/user_guide/upload/pic/'.$data['file_name'];
            echo json_encode(output(0,'上传成功',0,['src' => $image]));exit;
        }else{
            echo json_encode(output(1001,'上传失败'));exit;
        }
    }


}