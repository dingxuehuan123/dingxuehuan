<?php
/**
 * 问题业务层
 * @author dingxuehuan
 */
class Problem_service {

	private $CI;

	function __construct() {
		$this->CI = & get_instance ();
        $this->CI->load->model('problem_model');
        $this->CI->load->model('problem_cate_model');
	}

    /**
     * 获取问题类型列表
     */
    public function find_problem_cate_list($cate_name) {

        $problem_cates = $this->CI->problem_cate_model->get_all($cate_name);
        return output(0, '成功', count($problem_cates), $problem_cates);
    }

    /**
     * 新增编辑问题类型
     */
    public function save_problem_cate($id, $cate_name, $sub_cate_name) {
        if(empty($cate_name)){
            return output(1001, '请填写类型名称');
        }

        $data = array(
            'cate_name' => $cate_name,
            'sub_cate_name' => $sub_cate_name
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->problem_cate_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->problem_cate_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除问题类型
     */
    public function del_problem_cate($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $id_array = explode(',', $id);
        if(!empty($id_array)){
            foreach($id_array as $id){
                $where = array();
                $where['id'] = $id;
                $data['is_delete'] = 1;
                $data['update_time'] = date("Y-m-d H:i:s");
                $data['delete_time'] = date("Y-m-d H:i:s");
                $this->CI->problem_cate_model->query_update($where, $data);
            }
        }

        return output(0,'成功');
    }

    /**
     * 获取问题列表
     */
    public function find_problem_list($problem_cate_id, $problem, $page, $per_page) {

        $problems = $this->CI->problem_model->find_problem_list($problem_cate_id, $problem, $page, $per_page);
        $result = [];
        if(!empty($problems)){
            foreach($problems as $row){
                $row = object2array($row);
                $row['cate_name'] = $row['cate_name'].'-'.$row['sub_cate_name'];
                $result[] = array2object($row);
            }
        }
        $count = $this->CI->problem_model->find_problem_list_count($problem_cate_id, $problem);
        return output(0, '成功', $count->count, $result);
    }

    /**
     * 新增编辑问题
     */
    public function save_problem($id, $problem_cate_id, $problem, $answer) {
        if(empty($problem_cate_id)){
            return output(1001, '请选择问题类型');
        }
        if(empty($problem)){
            return output(1001, '请填写问题标题');
        }
        if(empty($answer)){
            return output(1001, '请填写问题答案');
        }

        $data = array(
            'problem_cate_id' => $problem_cate_id,
            'problem' => $problem,
            'answer' => $answer
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->problem_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->problem_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除问题
     */
    public function del_problem($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $id_array = explode(',', $id);
        if(!empty($id_array)){
            foreach($id_array as $id){
                $where = array();
                $where['id'] = $id;
                $data['is_delete'] = 1;
                $data['update_time'] = date("Y-m-d H:i:s");
                $data['delete_time'] = date("Y-m-d H:i:s");
                $this->CI->problem_model->query_update($where, $data);
            }
        }

        return output(0,'成功');
    }

}