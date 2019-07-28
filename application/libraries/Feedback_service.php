<?php
/**
 * 反馈业务层
 * @author dingxuehuan
 */
class Feedback_service {

	private $CI;

	function __construct() {
		$this->CI = & get_instance ();
        $this->CI->load->model('feedback_model');
	}

    /**
     * 获取反馈列表
     */
    public function find_feedback_list($software_product_id, $problem_cate_id, $feedback_content, $page, $per_page) {

        $feedbacks = $this->CI->feedback_model->find_feedback_list($software_product_id, $problem_cate_id, $feedback_content, $page, $per_page);
        $count = $this->CI->feedback_model->find_feedback_list_count($software_product_id, $problem_cate_id, $feedback_content);
        return output(0, '成功', $count->count, $feedbacks);
    }

    /**
     * 新增编辑反馈
     */
    public function save_feedback($id, $software_product_id, $problem_cate_id, $name, $feedback_content, $mobile, $image_urls, $audio_url, $urgent) {
        if(empty($name)){
            return output(1001, '请填写姓名');
        }
        if(empty($feedback_content)){
            return output(1001, '请填写反馈内容');
        }
        if(empty($problem_cate_id)){
            return output(1001, '请选择分类');
        }
        if(empty($software_product_id)){
            return output(1001, '请选择软件产品');
        }

        $data = array(
            'software_product_id' => $software_product_id,
            'problem_cate_id' => $problem_cate_id,
            'name' => $name,
            'feedback_content' => $feedback_content,
            'mobile' => $mobile,
            'image_urls' => $image_urls,
            'audio_url' => $audio_url,
            'urgent' => $urgent
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->feedback_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->feedback_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除反馈
     */
    public function del_feedback($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $where = array();
        $where['id'] = $id;
        $data['is_delete'] = 1;
        $data['update_time'] = date("Y-m-d H:i:s");
        $data['delete_time'] = date("Y-m-d H:i:s");
        $this->CI->feedback_model->query_update($where, $data);

        return output(0,'成功');
    }

    /**
     * 获取反馈
     */
    public function get_feedback($id) {
        $feedback = $this->CI->feedback_model->get_feedback($id);
        return output(0, '成功', $feedback);
    }

    /**
     * 开始处理
     */
    public function status($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $where = array();
        $where['id'] = $id;
        $data['status'] = 2;
        $data['update_time'] = date("Y-m-d H:i:s");
        $data['delete_time'] = date("Y-m-d H:i:s");
        $this->CI->feedback_model->query_update($where, $data);

        return output(0,'成功');
    }

    /**
     * 提交结果
     */
    public function feedback_result($feedback_result) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $where = array();
        $where['id'] = $id;
        $data['feedback_result'] = $feedback_result;
        $data['update_time'] = date("Y-m-d H:i:s");
        $data['delete_time'] = date("Y-m-d H:i:s");
        $this->CI->feedback_model->query_update($where, $data);

        return output(0,'成功');
    }

}