<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
 $routes->group('admin', static function ($routes) {
	 
    $routes->get('/', 'AdminDashboardController::index');
	
	$routes->get('chat', 'AdminChatController::index');
	
    $routes->get('dashboard', 'AdminDashboardController::index');
	
    $routes->get('users', 'AdminUserController::index');
	
    $routes->get('user', 'AdminUserController::index');
	
    $routes->post('user/doLogin', 'AdminUserController::doLogin');
	
    $routes->get('user/signup', 'AdminUserController::signup');
	
    $routes->get('user/edit', 'AdminUserController::edit');
	
    $routes->get('user/edit/(:any)', 'AdminUserController::edit/$1');
	
    $routes->post('user/edit/(:any)', 'AdminUserController::edit/$1');
	
    $routes->post('user/dit', 'AdminUserController::edit');
	
    $routes->get('user/delete/(:any)', 'AdminUserController::delete/$1');
	
    $routes->get('user/logout', 'AdminUserController::logout');
	
    $routes->get('user/state', 'AdminUserController::state');
	
    $routes->get('user/search', 'AdminUserController::search');
	
	$routes->get('settings', 'AdminSettingController::index');
	
		 
	$routes->post('settings', 'AdminSettingController::index');
	
	
	$routes->get('products', 'AdminProductController::index');
	
	$routes->get('product/edit', 'AdminProductController::edit');
	
    $routes->post('product/dit', 'AdminProductController::edit');
	
	$routes->get('product/edit/(:any)', 'AdminProductController::edit/$1');
	
    $routes->post('product/edit/(:any)', 'AdminProductController::edit/$1');
	
	$routes->get('product/state', 'AdminProductController::state');
	
    $routes->get('product/search', 'AdminProductController::search');
	
	$routes->get('product/delete/(:any)', 'AdminProductController::delete/$1');
	
	
	$routes->get('orders', 'AdminOrderController::index');
	
	$routes->get('order/edit', 'AdminOrderController::edit');
	
    $routes->post('order/dit', 'AdminOrderController::edit');
	
	$routes->get('order/edit/(:any)', 'AdminOrderController::edit/$1');
	
    $routes->post('order/edit/(:any)', 'AdminOrderController::edit/$1');
	
	$routes->get('order/delete/(:any)', 'AdminOrderController::delete/$1');
	
	$routes->get('order/orderdetailspdf/(:any)', 'AdminOrderController::orderdetailspdf/$1');
	
	
	$routes->get('payments', 'AdminPaymentController::index');
	
	$routes->get('payment/edit', 'AdminPaymentController::edit');
	
    $routes->post('payment/dit', 'AdminPaymentController::edit');
	
	$routes->get('payment/edit/(:any)', 'AdminPaymentController::edit/$1');
	
    $routes->post('payment/edit/(:any)', 'AdminPaymentController::edit/$1');
	
	$routes->get('payment/delete/(:any)', 'AdminPaymentController::delete/$1');
	
	$routes->get('currencies', 'AdminCurrencyController::index');
	
	$routes->get('currency/sync_exchanges', 'AdminCurrencyController::sync_exchanges');
	
	$routes->get('currency/edit', 'AdminCurrencyController::edit');
	
    $routes->post('currency/dit', 'AdminCurrencyController::edit');
	
	$routes->get('currency/edit/(:any)', 'AdminCurrencyController::edit/$1');
	
    $routes->post('currency/edit/(:any)', 'AdminCurrencyController::edit/$1');
	
	$routes->get('currency/delete/(:any)', 'AdminCurrencyController::delete/$1');
	
	$routes->get('currency/state', 'AdminCurrencyController::state');
	
	$routes->get('currency/sync/(:any)', 'AdminCurrencyController::sync/$1');

});
$routes->group('order', static function ($routes) {
	
	$routes->get('orderdetails/(:any)', 'OrderController::orderdetails/$1');
	
});
$routes->group('user', static function ($routes) {
	
	$routes->get('lostpassword', 'UserController::lostpassword');
		
	$routes->post('lostpassword', 'UserController::lostpassword');
	
	$routes->get('resetpassword', 'UserController::resetpassword');
		
	$routes->post('resetpassword', 'UserController::resetpassword');
	
	$routes->get('store', 'UserController::store');	
	 
	$routes->post('store', 'UserController::store');
	 
	$routes->get('login', 'UserController::login');
	 
	$routes->get('signup', 'UserController::signup');
	 
	$routes->post('doLogin', 'UserController::doLogin');
	 
	$routes->get('logout', 'UserController::logout');
	
	$routes->get('edit', 'UserController::edit');
	
    $routes->post('edit', 'UserController::edit');	
	
	$routes->get('uploadimage', 'UserController::uploadimage');
	
    $routes->post('uploadimage', 'UserController::uploadimage');
 
});

$routes->group('activities', static function ($routes) {
	
	$routes->get('edit', 'ActivitiesController::edit');
	
    $routes->post('edit', 'ActivitiesController::edit');	
	
	$routes->get('currency/(:any)', 'ActivitiesController::currency/$1');
	
	$routes->get('language/(:any)', 'ActivitiesController::language/$1');
	
});

$routes->group('market-place', static function ($routes) {
	
	$routes->get('/', 'MarketplaceController::index');
	
    $routes->get('filter', 'MarketplaceController::filter');
	
});


$routes->group('cart', static function ($routes) {
	
	$routes->get('/', 'CartController::index');
	
	$routes->get('countCart', 'CartController::countCart');
	
	$routes->get('deleteItemCart', 'CartController::deleteItemCart');
	
	$routes->get('deleteItem', 'CartController::deleteItem');
	
	$routes->get('addToCart', 'CartController::addToCart');
	
	$routes->get('saveCart', 'CartController::saveCart');
	
	$routes->post('complete_payment', 'CartController::complete_payment');
	
	$routes->get('thankyou', 'CartController::thankyou');
	
	$routes->get('fail', 'CartController::fail');
	
    $routes->get('maintain', 'CartController::maintain');
	
    $routes->get('getDropdownCart', 'CartController::getDropdownCart');
	
});

$routes->group('product', static function ($routes) {
	
	$routes->get('details/(:any)', 'ProductController::details/$1');
	
    $routes->post('details/(:any)', 'ProductController::details/$1');
	
});

$routes->get('/', 'Home::index');
$routes->get('sync/(:any)', 'Home::sync/$1');
$routes->get('currency-sync', 'Home::currencysync');
$routes->get('sync_auto/(:any)', 'Home::sync_auto/$1');
$routes->get('testemail', 'Home::testemail');
