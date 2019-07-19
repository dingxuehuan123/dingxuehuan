<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 软件产品表
 */
class Software_product_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'software_product';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

    public function find_software_product_list($product_name, $page, $per_page){
        $field = 'id,product_name,banner_url,intro,attachment_url';
        $where = 'is_delete=0';

        if (!empty($product_name)) {
            $where .= ' and product_name like "%' . $product_name . '%"';
        }
        
        $limit = $per_page * $page - $per_page;
        $offset = $per_page;
        $orderby = 'id asc';

        $sql = 'SELECT '.$field.' from software_product 
        WHERE '.$where.' order by '.$orderby.' limit '.$limit.', '.$offset;

        return $this->query_sql($sql);
    }

    public function find_software_product_list_count($product_name){
        $field = 'count(*) as count';
        $where = 'is_delete=0';

        if (!empty($product_name)) {
            $where .= ' and product_name like "%' . $product_name . '%"';
        }

        $sql = 'SELECT '.$field.' from software_product 
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

}

?>
