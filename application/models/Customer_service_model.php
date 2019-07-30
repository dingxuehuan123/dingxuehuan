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

    public function get_customer_service($id){
        $field = 'cs.feedback_content,cs.feedback_date,cs.mobile,cs.image_urls,cs.call_time,cs.talk_time,u1.name as user_name,u1.position,u2.name as customer_user_name,u3.name as responsible_user_name';
        $where = 'cs.is_delete=0 and cs.id='.$id;

        $sql = 'SELECT '.$field.' from customer_service cs
        left join software_product sp on cs.software_product_id=sp.id
        left join user u1 on cs.user_id=u1.id
        left join department d on u1.department_id=d.id
        left join user u2 on cs.customer_user_id=u2.id
        left join user u3 on cs.responsible_user_id=u3.id
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

    public function find_customer_service_list($software_product_id, $feedback_content, $page, $per_page){
        $field = 'cs.id,cs.software_product_id,cs.user_id,cs.customer_user_id,cs.responsible_user_id,cs.feedback_content,cs.feedback_date,cs.mobile,cs.image_urls,cs.call_time,cs.talk_time,u1.name as user_name,u1.position,u2.name as customer_user_name,u3.name as responsible_user_name,sp.product_name,d.department_name';
        $where = 'cs.is_delete=0';

        if(!empty($software_product_id)){
            $where .= ' and cs.software_product_id='.$software_product_id;
        }
        if (!empty($feedback_content)) {
            $where .= ' and cs.feedback_content like "%' . $feedback_content . '%"';
        }
        
        $limit = $per_page * $page - $per_page;
        $offset = $per_page;
        $orderby = 'cs.id asc';

        $sql = 'SELECT '.$field.' from customer_service cs
        left join software_product sp on cs.software_product_id=sp.id
        left join user u1 on cs.user_id=u1.id
        left join department d on u1.department_id=d.id
        left join user u2 on cs.customer_user_id=u2.id
        left join user u3 on cs.responsible_user_id=u3.id
        WHERE '.$where.' order by '.$orderby.' limit '.$limit.', '.$offset;

        return $this->query_sql($sql);
    }

    public function find_customer_service_list_count($software_product_id, $feedback_content){
        $field = 'count(*) as count';
        $where = 'cs.is_delete=0';

        if(!empty($software_product_id)){
            $where .= ' and cs.software_product_id='.$software_product_id;
        }
        if (!empty($feedback_content)) {
            $where .= ' and cs.feedback_content like "%' . $feedback_content . '%"';
        }

        $sql = 'SELECT '.$field.' from customer_service cs
        left join software_product sp on cs.software_product_id=sp.id
        left join user u1 on cs.user_id=u1.id
        left join department d on u1.department_id=d.id
        left join user u2 on cs.customer_user_id=u2.id
        left join user u3 on cs.responsible_user_id=u3.id
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

}

?>
