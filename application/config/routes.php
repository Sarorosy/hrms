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
$route['/'] = 'Dashboard';
$route['login'] = 'Login';
$route['rewards'] = 'Employees/rewards';
$route['asset'] = 'Asset/index';
$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['manage-payroll'] = 'ManagePayroll/index';
$route['manage-payroll/add/(:any)'] = 'ManagePayroll/manage_payroll_add/$1';
$route['manage-payroll/view_all_payslips/(:any)'] = 'ManagePayroll/view_user_allpayslips/$1';
$route['payslips/(:any)'] = 'ManagePayroll/view_user_allpayslips/$1';
$route['manage-payroll/delete_payslip/(:any)'] = 'ManagePayroll/delete_payslip/$1' ;
//private allowances deductions bonus
$route['managepayroll/add_bonus_deduction'] = 'ManagePayroll/add_bonus_deduction';
$route['managepayroll/edit_bonus_deduction'] = 'ManagePayroll/edit_bonus_deduction';
$route['managepayroll/delete_head/(:num)'] = 'ManagePayroll/delete_head/$1';

//common allowances deductions bonus
$route['managepayroll/add_common_bonus_deduction'] = 'ManagePayroll/add_common_bonus_deduction';
$route['managepayroll/edit_common_bonus_deduction'] = 'ManagePayroll/edit_common_bonus_deduction';
$route['managepayroll/delete_common_bonus_deduction/(:num)'] = 'ManagePayroll/delete_common_bonus_deduction/$1';

$route['managepayroll/generate_payslip/(:any)'] = 'ManagePayroll/generate_payslip/$1';
$route['manage-payroll/view_payslip/(:any)'] = 'ManagePayroll/view_payslip/$1';
$route['manage-payroll/view-payslip-details/(:any)'] = 'ManagePayroll/view_payslip_details/$1';

$route['managepayroll/common_heads'] = 'ManagePayroll/common_heads';
$route['managepayroll/private_heads'] = 'ManagePayroll/private_heads';
$route['managepayroll/get_head/(:any)'] = 'ManagePayroll/get_head/$1';
// $route['login/authenticate'] = 'Login/authenticate';
// $route['welcome'] = 'Index';