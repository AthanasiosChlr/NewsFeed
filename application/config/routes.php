<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'MainController/';
$route['homepage'] = 'MainController/index';
$route['technology'] = 'NewsCategoriesController/technology';
$route['business'] = 'NewsCategoriesController/business';
$route['entertainment'] = 'NewsCategoriesController/entertainment';
$route['science'] = 'NewsCategoriesController/science';
$route['health'] = 'NewsCategoriesController/health';
$route['lifestyle'] = 'NewsCategoriesController/lifestyle';
$route['food'] = 'NewsCategoriesController/food';
$route['education'] = 'NewsCategoriesController/education';
$route['sports'] = 'NewsCategoriesController/sports';
$route['tourism'] = 'NewsCategoriesController/tourism';
$route['politics'] = 'NewsCategoriesController/politics';

$route['search'] = 'NewsCategoriesController/search';
$route['login/process'] = 'MainController/processLogin';
$route['register_user'] = 'MainController/register_user';
$route['request_password_reset'] = 'PasswordResetController/request_password_reset';
$route['reset_password/(:any)'] = 'PasswordResetController/reset_password/$1';
$route['admin'] = 'AdminController/showLogin';
$route['admin/process'] = 'AdminController/processLogin';

$route['dashboard'] = 'Dashboard';
$route['dashboard/update_profile'] = 'Dashboard/update_profile';
$route['customers'] = 'AdminController/customers';
$route['update_customer/(:num)'] = 'AdminController/update_customer/$1';
$route['delete_customer/(:num)'] = 'AdminController/delete_customer/$1';

$route['messages'] = 'Dashboard/messages';
$route['send_message'] = 'Dashboard/send_message';
$route['send_message/submit_message'] = 'Dashboard/submit_message';
$route['delete_message'] = 'Dashboard/delete_message';
$route['view_user_messages/(:num)'] = 'AdminController/view_user_messages/$1';
$route['logout'] = 'MainController/logout';

$route['404_override'] = 'MainController/error_404';
$route['translate_uri_dashes'] = FALSE;
