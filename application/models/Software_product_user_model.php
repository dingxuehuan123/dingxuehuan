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

    public function find_software_product_user_list($software_product_id, $department_id, $keyword, $page, $per_page){
        $field = 'spu.id,u.job_num,u.name,u.sex,u.mobile,u.email,u.position,d.department_name,sp.product_name';
        $where = 'spu.is_delete=0';

        if(!empty($software_product_id)){
            $where .= ' and spu.software_product_id='.$software_product_id;
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

        $sql = 'SELECT '.$field.' from software_product_user spu
        left join user u on spu.user_id=u.id
        left join department d on u.department_id=d.id
        left join software_product sp on spu.software_product_id=sp.id
        WHERE '.$where.' order by '.$orderby.' limit '.$limit.', '.$offset;

        return $this->query_sql($sql);
    }

    public function find_software_product_user_list_count($software_product_id, $department_id, $keyword){
        $field = 'count(*) as count';
        $where = 'spu.is_delete=0';

        if(!empty($software_product_id)){
            $where .= ' and spu.software_product_id='.$software_product_id;
        }
        if(!empty($department_id)){
            $where .= ' and u.department_id='.$department_id;
        }
        if (!empty($keyword)) {
            $where .= ' and (u.job_num like "%' . $keyword . '%" or u.name like "%' . $keyword . '%" or u.mobile like "%' . $keyword . '%")';
        }

        $sql = 'SELECT '.$field.' from software_product_user spu
        left join user u on spu.user_id=u.id
        left join department d on u.department_id=d.id
        left join software_product sp on spu.software_product_id=sp.id
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

}

?>
