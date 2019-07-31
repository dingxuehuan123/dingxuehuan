<?php
/**
 * 前台用户业务层
 * @author dingxuehuan
 */
class Member_service {

	private $CI;

	function __construct() {
		$this->CI = & get_instance ();
        $this->CI->load->model('member_model');
	}

    /**
     * 获取所有前台用户
     */
    public function find_all_member() {
        $members = $this->CI->member_model->get_all();

        $mine = [
            'username' => '新海集团',
            'status' => 'online',
            'avatar' => '//res.layui.com/images/fly/avatar/00.jpg'
        ];

        $friend[] = [
            'groupname' => '前台用户',
            'id' => 0,
            'list' => $members
        ];

        $result = [
            'mine' => $mine,
            'friend' => $friend
        ];
        return output(0, '成功', count($members), $result);
    }

}