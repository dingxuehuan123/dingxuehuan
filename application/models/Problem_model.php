<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 问题表
 */
class Problem_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'problem';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

    public function find_problem_list($problem_cate_id, $problem, $page, $per_page){
        $field = 'p.id,p.problem,p.answer,pc.id as cate_id, pc.cate_name,pc.sub_cate_name';
        $where = 'p.is_delete=0';

        if(!empty($problem_cate_id)){
            $where .= ' and p.problem_cate_id='.$problem_cate_id;
        }
        if (!empty($problem)) {
            $where .= ' and p.problem like "%' . $problem . '%"';
        }
        
        $limit = $per_page * $page - $per_page;
        $offset = $per_page;
        $orderby = 'p.id asc';

        $sql = 'SELECT '.$field.' from problem p
        left join problem_cate pc on p.problem_cate_id=pc.id
        WHERE '.$where.' order by '.$orderby.' limit '.$limit.', '.$offset;

        return $this->query_sql($sql);
    }

    public function find_problem_list_count($problem_cate_id, $problem){
        $field = 'count(*) as count';
        $where = 'p.is_delete=0';

        if(!empty($problem_cate_id)){
            $where .= ' and p.problem_cate_id='.$problem_cate_id;
        }
        if (!empty($problem)) {
            $where .= ' and p.problem like "%' . $problem . '%"';
        }

        $sql = 'SELECT '.$field.' from problem p
        left join problem_cate pc on p.problem_cate_id=pc.id
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

}

?>
