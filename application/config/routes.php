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
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// AJAX
$route['request/ajax/(:any)'] = 'ajax/$1';
//Admin 
// ==== Guru ==== //
$route['admin/list-guru'] = 'Admin/ListGuru';
$route['admin/list-guru/(:any)'] = 'Admin/ListGuru/$1';

// ==== Kelas ==== //
$route['admin/list-kelas'] = 'Admin/ListKelas';
$route['admin/list-kelas/(:any)'] = 'Admin/ListKelas/$1';

// ==== Murid ==== //
$route['admin/list-murid'] = 'Admin/ListMurid';
$route['admin/list-murid/(:any)'] = 'Admin/ListMurid/$1';

// ==== Wali Murid ==== //
$route['admin/list-wali-murid'] = 'Admin/ListWaliMurid';
$route['admin/list-wali-murid/(:any)'] = 'Admin/ListWaliMurid/$1';


// ==== Lainnya ==== //
$route['pengaturan'] = 'Dashboard/setting';
$route['change-password/(:any)'] = 'Dashboard/setting_password/$1';

//Guru 
// ==== Input Pelanggaran ==== //
$route['dashboard/list-pelanggaran'] = 'dashboard/ListPelanggaran';
$route['dashboard/list-pelanggaran/(:any)'] = 'dashboard/ListPelanggaran/$1';

// ==== Input Pelanggaran ==== //
$route['kategori-pelanggaran/(:num)'] = 'kategori_pelanggaran/edit/$1';

$route['logout'] = 'auth/logout';