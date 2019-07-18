<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 客服台账表
 */
class Customer_service_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'customer_service';
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
