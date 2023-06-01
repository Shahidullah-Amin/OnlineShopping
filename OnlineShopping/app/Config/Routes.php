<?php

namespace Config;

$routes = Services::routes();


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);




$routes->add('/', 'Auth::user_authenticate');
$routes->post('/', 'Auth::confirm');

$routes->group('user' , function($routes){
    $routes->post('register' , 'Auth::save');
    $routes->post('login', 'Auth::check');
    $routes->get('logout/(:num)', 'Auth::logout/$1');
});

$routes->get('user-permission', 'Auth::user_permission');

$routes->group('user' ,['filter'=>'LoggedInFilter'], function($routes){
    
    $routes->get('register' , 'Auth::register');
    $routes->get('login', 'Auth::login');
});


$routes->group('product' ,['filter'=>'AuthCheckFilter'], function($routes){
    $routes->add('add-product', 'ProductController\Product::add_product');
    $routes->add('get-product' , 'ProductController\Product::get_product');
    $routes->get('all', 'ProductController\Product::get_all_products');
    $routes->add('delete/(:any)' , "ProductController\Product::delete_product/$1");
    $routes->add('update/(:any)' , "ProductController\Product::update_product/$1");
});






if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
