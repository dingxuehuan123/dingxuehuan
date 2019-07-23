<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 用户角色表
 */
class User_role_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'user_role';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

    public function get_all(){
        $field = 'id, role_name';
        $where = array();
        $where['is_delete'] = 0;
        $orderby = 'id asc';
        return $this->query_all($field, $where, $orderby);
    }

}

?>
