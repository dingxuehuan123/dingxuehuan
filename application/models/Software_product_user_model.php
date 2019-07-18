<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 产品服务用户关联表
 */
class Software_product_user_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'software_product_user';
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
