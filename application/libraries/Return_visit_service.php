<?php
/**
 * 回访计划业务层
 * @author dingxuehuan
 */
class Return_visit_service {

	private $CI;

	function __construct() {
		$this->CI = & get_instance ();
        $this->CI->load->model('return_visit_model');
	}

    /**
     * 获取回访计划列表
     */
    public function find_return_visit_list($page, $per_page) {

        $return_visits = $this->CI->return_visit_model->find_return_visit_list($page, $per_page);
        $count = $this->CI->return_visit_model->find_return_visit_list_count();
        return output(0, '成功', $count->count, $return_visits);
    }

    /**
     * 新增编辑回访计划
     */
    public function save_return_visit($id, $feedback_id, $customer_service_id, $customer_user_id, $return_visit_reasons, $return_visit_content, $return_visit_time) {

        $data = array(
            'feedback_id' => $feedback_id,
            'customer_service_id' => $customer_service_id,
            'customer_user_id' => $customer_user_id,
            'return_visit_reasons' => $return_visit_reasons,
            'return_visit_content' => $return_visit_content,
            'return_visit_time' => $return_visit_time
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->return_visit_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->return_visit_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除回访计划
     */
    public function del_return_visit($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $where = array();
        $where['id'] = $id;
        $data['is_delete'] = 1;
        $data['update_time'] = date("Y-m-d H:i:s");
        $data['delete_time'] = date("Y-m-d H:i:s");
        $this->CI->return_visit_model->query_update($where, $data);

        return output(0,'成功');
    }

    /**
     * 获取回访计划
     */
    public function get_return_visit($id) {
        $return_visit = $this->CI->return_visit_model->get_return_visit($id);
        return output(0, '成功', $return_visit);
    }

}