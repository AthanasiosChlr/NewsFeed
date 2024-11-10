<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['login/verify'] = 'MainController/verify';
$route['register_user'] = 'MainController/register_user';
$route['admin'] = 'AdminController/login';
$route['admin/verify'] = 'AdminController/admin_login';

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
