<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$config['base_url'] = $this->config->item('domain_www');
$route['default_controller'] = "welcome";

//后台
$route['admin'] = "admin/login"; //登录
$route['privilege/login_out'] = "admin/login/login_out"; //退出
//后台 - 权限
$route['privilege/account_info'] = "admin/privilege/system_account/account_info"; //个人资料
$route['privilege/edit_password'] = "admin/privilege/system_account/edit_password"; //修改密码页面
$route['privilege/ajax_edit_password'] = "admin/privilege/system_account/ajax_edit_password"; //修改密码
//后台 - 账户管理
$route['privilege/user_list'] = "admin/privilege/system_account/user_list"; //用户管理-列表
$route['privilege/user_detail'] = "admin/privilege/system_account/user_detail"; //用户管理-详细页
$route['privilege/update_system_user'] = "admin/privilege/system_account/update_system_user"; //用户管理-添加更新
$route['privilege/update_enable_status'] = "admin/privilege/system_account/update_enable_status"; //用户管理-禁用启用操作
