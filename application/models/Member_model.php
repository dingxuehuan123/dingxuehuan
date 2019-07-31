<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 前台用户表
 */
class Member_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'member';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

    public function get_all(){
        $field = 'id,name';
        $where = array();
        $where['is_delete'] = 0;
        $orderby = 'id asc';
        return $this->query_all($field, $where, $orderby);
    }

}

?>
