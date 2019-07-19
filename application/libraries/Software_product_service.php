<?php
/**
 * 软件产品业务层
 * @author dingxuehuan
 */
class Software_product_service {

	private $CI;

	function __construct() {
		$this->CI = & get_instance ();
        $this->CI->load->model('software_product_model');
        $this->CI->load->model('problem_cate_model');
        $this->CI->load->model('software_product_problem_model');
	}

    /**
     * 获取用户列表
     */
    public function find_software_product_list($product_name, $page, $per_page) {

        $software_products = $this->CI->software_product_model->find_software_product_list($product_name, $page, $per_page);
        $count = $this->CI->software_product_model->find_software_product_list_count($product_name);
        return output(0, '成功', ['software_products'=>$software_products, 'count'=>$count->count]);
    }

    /**
     * 新增编辑用户
     */
    public function save_software_product($id, $product_name, $banner_url, $intro, $attachment_url) {
        if(empty($product_name)){
            return output(1001, '请填写软件产品名称');
        }

        $data = array(
            'product_name' => $product_name,
            'banner_url' => $banner_url,
            'intro' => $intro,
            'attachment_url' => $attachment_url
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->software_product_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->software_product_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除用户
     */
    public function software_product_model($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $where = array();
        $where['id'] = $id;
        $data['is_delete'] = 1;
        $data['update_time'] = date("Y-m-d H:i:s");
        $data['delete_time'] = date("Y-m-d H:i:s");
        $this->CI->software_product_model->query_update($where, $data);

        return output(0,'成功');
    }

}