<?php

defined('BASEPATH') or die('No direct script access allowed');

/**
 * 反馈表
 */
class Feedback_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'feedback';
	}

    public function get_by_id($id){
        $field = '*';
        $where = array();
        $where['id'] = $id;
        $where['is_delete'] = 0;
        return $this->query_result($field, $where);
    }

    public function get_feedback($id){
        $field = 'f.id,f.name,f.feedback_content,f.mobile,f.image_urls,f.audio_url,f.urgent,sp.product_name,pc.cate_name,pc.sub_cate_name';
        $where = 'f.is_delete=0 and f.id='.$id;

        $sql = 'SELECT '.$field.' from feedback f
        left join software_product sp on f.software_product_id=sp.id
        left join problem_cate pc on f.problem_cate_id=pc.id
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

    public function find_feedback_list($software_product_id, $problem_cate_id, $feedback_content, $page, $per_page){
        $field = 'f.id,f.name,f.feedback_content,f.mobile,f.image_urls,f.audio_url,f.urgent,sp.product_name,pc.cate_name,pc.sub_cate_name';
        $where = 'f.is_delete=0';

        if(!empty($software_product_id)){
            $where .= ' and f.software_product_id='.$software_product_id;
        }
        if(!empty($problem_cate_id)){
            $where .= ' and f.problem_cate_id='.$problem_cate_id;
        }
        if (!empty($feedback_content)) {
            $where .= ' and f.feedback_content like "%' . $feedback_content . '%"';
        }
        
        $limit = $per_page * $page - $per_page;
        $offset = $per_page;
        $orderby = 'f.id asc';

        $sql = 'SELECT '.$field.' from feedback f
        left join software_product sp on f.software_product_id=sp.id
        left join problem_cate pc on f.problem_cate_id=pc.id
        WHERE '.$where.' order by '.$orderby.' limit '.$limit.', '.$offset;

        return $this->query_sql($sql);
    }

    public function find_feedback_list_count($software_product_id, $problem_cate_id, $feedback_content){
        $field = 'count(*) as count';
        $where = 'f.is_delete=0';

        if(!empty($software_product_id)){
            $where .= ' and f.software_product_id='.$software_product_id;
        }
        if(!empty($problem_cate_id)){
            $where .= ' and f.problem_cate_id='.$problem_cate_id;
        }
        if (!empty($feedback_content)) {
            $where .= ' and f.feedback_content like "%' . $feedback_content . '%"';
        }
        

        $sql = 'SELECT '.$field.' from feedback f
        left join software_product sp on f.software_product_id=sp.id
        left join problem_cate pc on f.problem_cate_id=pc.id
        WHERE '.$where;

        return $this->query_sql_row($sql);
    }

}

?>
