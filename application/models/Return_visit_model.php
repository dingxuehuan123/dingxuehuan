<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 回访表
 */
class Return_visit_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'return_visit';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

    public function get_return_visit($id){
        $field = 'id,feedback_id,customer_service_id,customer_user_id,return_visit_reasons,return_visit_content,return_visit_time';
        $where = 'is_delete=0 and id='.$id;

        $sql = 'SELECT '.$field.' from return_visit 
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

    public function find_return_visit_list($page, $per_page){
        $field = 'id,feedback_id,customer_service_id,customer_user_id,return_visit_reasons,return_visit_content,return_visit_time';
        $where = 'is_delete=0';
        
        $limit = $per_page * $page - $per_page;
        $offset = $per_page;
        $orderby = 'id asc';

        $sql = 'SELECT '.$field.' from return_visit 
        WHERE '.$where.' order by '.$orderby.' limit '.$limit.', '.$offset;

        return $this->query_sql($sql);
    }

    public function find_return_visit_list_count(){
        $field = 'count(*) as count';
        $where = 'is_delete=0';

        $sql = 'SELECT '.$field.' from return_visit 
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

}

?>
