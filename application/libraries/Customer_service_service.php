<?php
/**
 * 客服台账业务层
 * @author dingxuehuan
 */
class Customer_service_service {

	private $CI;

	function __construct() {
		$this->CI = & get_instance ();
        $this->CI->load->model('customer_service_model');
	}

    /**
     * 获取客服台账列表
     */
    public function find_customer_service_list($software_product_id, $feedback_content, $page, $per_page) {

        $customer_services = $this->CI->customer_service_model->find_customer_service_list($software_product_id, $feedback_content, $page, $per_page);
        $count = $this->CI->customer_service_model->find_customer_service_list_count($software_product_id, $feedback_content);
        return output(0, '成功', ['customer_services'=>$customer_services, 'count'=>$count->count]);
    }

    /**
     * 新增编辑客服台账
     */
    public function save_customer_service($id, $software_product_id, $user_id, $customer_user_id, $responsible_user_id, $feedback_content, $feedback_date, $mobile, $image_urls, $call_time, $talk_time) {
        
        if(empty($software_product_id)){
            return output(1001, '请选择软件产品');
        }
        if(empty($feedback_content)){
            return output(1001, '请填写反馈内容');
        }

        $data = array(
            'software_product_id' => $software_product_id,
            'user_id' => $user_id,
            'customer_user_id' => $customer_user_id,
            'responsible_user_id' => $responsible_user_id,
            'feedback_content' => $feedback_content,
            'feedback_date' => $feedback_date,
            'mobile' => $mobile,
            'image_urls' => $image_urls,
            'call_time' => $call_time,
            'talk_time' => $talk_time
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->customer_service_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->customer_service_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除客服台账
     */
    public function del_customer_service($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $where = array();
        $where['id'] = $id;
        $data['is_delete'] = 1;
        $data['update_time'] = date("Y-m-d H:i:s");
        $data['delete_time'] = date("Y-m-d H:i:s");
        $this->CI->customer_service_model->query_update($where, $data);

        return output(0,'成功');
    }

    /**
     * 获取客服台账
     */
    public function get_customer_service($id) {
        $customer_service = $this->CI->customer_service_model->get_customer_service($id);
        return output(0, '成功', $customer_service);
    }

}