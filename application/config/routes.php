<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Custom routes
$route['posts/index'] = 'posts/index';
$route['categories'] = 'categories/index';
$route['categories/(:any)'] = 'categories/single/$1';
$route['posts/create'] = 'posts/create';
$route['posts/(:any)'] = 'posts/single/$1';
$route['posts'] = 'posts/index';
$route['(:any)'] = 'pages/view/$1';


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

