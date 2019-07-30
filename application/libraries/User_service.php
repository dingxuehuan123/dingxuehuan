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
        $this->CI->load->model('software_product_user_model');
	}

    /**
     * 获取用户角色列表
     */
    public function find_user_role_list() {

        $user_roles = $this->CI->user_role_model->get_all();
        return output(0, '成功', count($user_roles), $user_roles);
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
        $id_array = explode(',', $id);
        if(!empty($id_array)){
            foreach($id_array as $id){
                $where = array();
                $where['id'] = $id;
                $data['is_delete'] = 1;
                $data['update_time'] = date("Y-m-d H:i:s");
                $data['delete_time'] = date("Y-m-d H:i:s");
                $this->CI->user_role_model->query_update($where, $data);
            }
        }

        return output(0,'成功');
    }

    /**
     * 获取用户列表
     */
    public function find_user_list($role_id, $department_id, $keyword, $page, $per_page) {

        $users = $this->CI->user_model->find_user_list($role_id, $department_id, $keyword, $page, $per_page);
        $count = $this->CI->user_model->find_user_list_count($role_id, $department_id, $keyword);
        return output(0, '成功', $count->count, $users);
    }

    /**
     * 新增编辑用户
     */
    public function save_user($id, $role_id, $department_id, $job_num, $name, $mobile) {
        if(empty($role_id)){
            return output(1001, '请选择角色');
        }
        if(empty($department_id)){
            return output(1001, '请选择部门');
        }
        if(empty($job_num)){
            return output(1001, '请填写工号');
        }
        if(empty($name)){
            return output(1001, '请填写姓名');
        }
        if(empty($mobile)){
            return output(1001, '请填写联系方式');
        }

        $data = array(
            'user_role_id' => $role_id,
            'department_id' => $department_id,
            'job_num' => $job_num,
            'name' => $name,
            'mobile' => $mobile
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->user_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->user_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除用户
     */
    public function del_user($id) {
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
                $this->CI->user_model->query_update($where, $data);
            }
        }
        return output(0,'成功');
    }

    /**
     * 获取服务对象列表
     */
    public function find_software_product_user_list($software_product_id, $department_id, $keyword, $page, $per_page) {

        $software_product_users = $this->CI->software_product_user_model->find_software_product_user_list($software_product_id, $department_id, $keyword, $page, $per_page);
        $count = $this->CI->software_product_user_model->find_software_product_user_list_count($software_product_id, $department_id, $keyword);
        return output(0, '成功', $count->count, $software_product_users);
    }

    /**
     * 新增编辑服务对象
     */
    public function save_software_product_user($id, $software_product_id, $user_id) {
        if(empty($software_product_id)){
            return output(1001, '请选择产品');
        }
        if(empty($user_id)){
            return output(1001, '请选择用户');
        }

        $data = array(
            'software_product_id' => $software_product_id,
            'user_id' => $user_id
        );
        if(empty($id)){
            $data['create_time'] = date("Y-m-d H:i:s");
            $this->CI->software_product_user_model->query_insert($data);
        }else{
            $where = array();
            $where['id'] = $id;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->CI->software_product_user_model->query_update($where, $data);
        }

        return output(0,'成功');
    }

    /**
     * 删除服务对象
     */
    public function del_software_product_user($id) {
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
                $this->CI->software_product_user_model->query_update($where, $data);
            }
        }

        return output(0,'成功');
    }

    /**
     * 获取所有部门
     */
    public function get_all_department() {
        $this->CI->load->model('department_model');
        $departments = $this->CI->department_model->get_all();
        return output(0, '成功', count($departments), $departments);
    }

}