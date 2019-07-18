<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 问题分类表
 */
class Problem_cate_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'problem_cate';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

}

?>
