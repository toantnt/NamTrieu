<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['404_override'] = '';
//$route['auth'] = 'users/auth';
//$route['auth/(.*)'] = 'users/auth/$1';

// public Routes

$route['default_controller'] = 'home/home';
$route['vi'] = "home/home";
$route['en'] = "home/home";
$route['jp'] = "home/home";

$route['vi/login']      = 'account/login/index';
$route['en/login'] 	    = 'account/login/index';
$route['jp/login']      = 'account/login/index';

$route['vi/register']   = 'account/register/index';
$route['en/register']   = 'account/register/index';
$route['jp/register']   = 'account/register/index';

$route['vi/gioi-thieu'] = 'home/home/about';
$route['en/about-us']   = 'home/home/about';
$route['jp/about-us']   = 'home/home/about';

$route['en/forgot']		= 'account/forgot/index';
$route['vi/forgot']		= 'account/forgot/index';
$route['jp/forgot']		= 'account/forgot/index';


$route['vi/lien-he'] 	= 'home/page/contact';
$route['en/contact'] 	= 'home/page/contact';
$route['jp/contact'] 	= 'home/page/contact';

$route['vi/team/([a-zA-Z0-9-_]+)'] 	 = 'home/home/persons/$1';
$route['en/team/([a-zA-Z0-9-_]+)']   = 'home/home/persons/$1';

$route['setup']         = 'home/setup/index';
//$route['post'] = 'posts/post';
//$route['dashboard'] = 'dashboard/index';
$route['admin'] 		 = 'admin/dashboard';
$route['account/forgot'] = 'account/auth/forgot';

// ADMIN ROUTE

$route['admin/pages'] 				= 'admin/pages/index';
$route['admin/pages/'] 				= 'admin/pages/index/0';
$route['admin/pages/(:num)'] 		= 'admin/pages/index/$1';


$route['admin/slide'] 				= 'admin/slide/index';
$route['admin/slide/'] 				= 'admin/slide/index/0';
$route['admin/slide/(:num)'] 		= 'admin/slide/index/$1';

$route['posts/controlpanel'] 		= 'posts/controlpanel/index';
$route['posts/controlpanel/']  		= 'posts/controlpanel/index/0';
$route['posts/controlpanel/(:num)'] = 'posts/controlpanel/index/$1';

$route['admin/orders'] 				= 'admin/orders/index';
$route['admin/orders/']  			= 'admin/orders/index/0';
$route['admin/orders/(:num)'] 		= 'admin/orders/index/$1';

$route['member/controlpanel'] 		= 'member/controlpanel/index';
$route['member/controlpanel']  		= 'member/controlpanel/index/0';
$route['member/controlpanel'] 		= 'member/controlpanel/index/$1';


///////////////// -----------DOWNLOAD----------- ///////////////////////member/controlpanel
 

$route['vi/([a-zA-Z0-9-_]+)-c(:num)'] 			= 'home/category/index/$1/$2';
$route['vi/([a-zA-Z0-9-_]+)-c(:num)/'] 			= 'home/category/index/$1/$2/0';
$route['vi/([a-zA-Z0-9-_]+)-c(:num)/(:num)'] 	= 'home/category/index/$1/$2/$3';

$route['en/([a-zA-Z0-9-_]+)-c(:num)'] 			= 'home/category/index/$1/$2';
$route['en/([a-zA-Z0-9-_]+)-c(:num)/'] 			= 'home/category/index/$1/$2/0';
$route['en/([a-zA-Z0-9-_]+)-c(:num)/(:num)'] 	= 'home/category/index/$1/$2/$3';


$route['vi/([a-zA-Z0-9-_]+)-a(:num)'] = 'home/post/detail/$1/$2';
$route['en/([a-zA-Z0-9-_]+)-a(:num)'] = 'home/post/detail/$1/$2'; 

$route['vi/([a-zA-Z0-9-_]+)-s(:num)'] = 'home/shop/detail/$1/$2';
$route['en/([a-zA-Z0-9-_]+)-s(:num)'] = 'home/shop/detail/$1/$2'; 


$route['vi/([a-zA-Z0-9-_]+)-n(:num)'] = 'post/post/index/$1/$2';
$route['en/([a-zA-Z0-9-_]+)-n(:num)'] = 'post/post/index/$1/$2'; 


$route['sitemap\.xml'] = 'home/home/sitemap';
/* End of file routes.php */
/* Location: ./application/config/routes.php */