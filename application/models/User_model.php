<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 用户表
 */
class User_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'user';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

    public function find_user_list($role_id, $department_id, $keyword, $page, $per_page){
        $field = 'u.id,u.job_num,u.name,u.mobile,ur.role_name,d.department_name';
        $where = 'u.is_delete=0';

        if(!empty($role_id)){
            $where .= ' and u.user_role_id='.$role_id;
        }
        if(!empty($department_id)){
            $where .= ' and u.department_id='.$department_id;
        }
        if (!empty($keyword)) {
            $where .= ' and (u.job_num like "%' . $keyword . '%" or u.name like "%' . $keyword . '%" or u.mobile like "%' . $keyword . '%")';
        }
        
        $limit = $per_page * $page - $per_page;
        $offset = $per_page;
        $orderby = 'u.id asc';

        $sql = 'SELECT '.$field.' from user u
        left join user_role ur on u.user_role_id=ur.id
        left join department d on u.department_id=d.id
        WHERE '.$where.' order by '.$orderby.' limit '.$limit.', '.$offset;

        return $this->query_sql($sql);
    }

    public function find_user_list_count($role_id, $department_id, $keyword){
        $field = 'count(*) as count';
        $where = 'u.is_delete=0';

        if(!empty($role_id)){
            $where .= ' and u.user_role_id='.$role_id;
        }
        if(!empty($department_id)){
            $where .= ' and u.department_id='.$department_id;
        }
        if (!empty($keyword)) {
            $where .= ' and (u.job_num like "%' . $keyword . '%" or u.name like "%' . $keyword . '%" or u.mobile like "%' . $keyword . '%")';
        }

        $sql = 'SELECT '.$field.' from user u
        left join user_role ur on u.user_role_id=ur.id
        left join department d on u.department_id=d.id
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

}

?>
