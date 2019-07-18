<?php
/**
 * 用户业务层
 * @author dingxuehuan
 */
class User_service {

	private $CI;

	function __construct() {
		$this->CI = & get_instance ();
        $this->CI->load->model('user_model');
        $this->CI->load->model('user_role_model');
	}

    /**
     * 获取用户角色列表
     */
    public function find_user_role_list() {

        $user_roles = $this->CI->user_role_model->get_all();
        return output(0, '成功', $user_roles);
    }

    /**
     * 新增编辑用户角色
     */
    public function save_user_role($id, $role_name) {
        if(empty($role_name)){
            return output(1001, '参数错误');
        }

        $data = array(
            'role_name' => $role_name
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->user_role_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->user_role_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除用户角色
     */
    public function del_user_role($id) {
        if(empty($id)){
            return output(1, '参数错误');
        }
        $where = array();
        $where['id'] = $id;
        $data['is_delete'] = 1;
        $data['update_time'] = date("Y-m-d H:i:s");
        $data['delete_time'] = date("Y-m-d H:i:s");
        $this->CI->user_role_model->query_update($where, $data);

        return output(0,'成功');
    }

}