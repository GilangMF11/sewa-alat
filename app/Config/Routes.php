<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/galeri', 'Home::allProducts');
$routes->get('product/detail/(:any)', 'Home::detailProduct/$1');

$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::registerProses');
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::loginProses');
// Logout
$routes->get('/logout', 'Auth\AuthController::logout');

$routes->get('/show/product/(:any)', 'Home::showImage/$1');
$routes->get('/show/image/(:any)', 'Home::showImageHome/$1');
$routes->get('/show/logo/(:any)', 'Home::showImageLogo/$1');

// get user
$routes->get('user/search', 'User\UserController::search');




// app/Config/Routes.php

$routes->group('', ['filter' => 'auth'], function($routes) {

    $routes->get('/show/payment/(:any)', 'Home::showImageProofOfPayments/$1');
    $routes->get('/dashboard', 'Dashboard\DashboardController::index');

    // category
    $routes->group('category', ['namespace' => 'App\Controllers\Category'], function($routes) {
        $routes->get('/', 'CategoryController::index');
        $routes->post('store', 'CategoryController::store');
        $routes->get('delete/(:segment)', 'CategoryController::delete/$1');
    });

    // product
    $routes->group('product', ['namespace' => 'App\Controllers\Product'], function($routes) {
        $routes->get('/', 'ProductController::index');
        $routes->post('store', 'ProductController::store');
        $routes->get('delete/(:segment)', 'ProductController::delete/$1');
    });

    // Transaction
    $routes->group('order', ['namespace' => 'App\Controllers\Transaction'], function($routes) {
        $routes->get('/', 'TransactionController::index');
        $routes->post('store', 'TransactionController::store');
        $routes->get('delete/(:segment)', 'TransactionController::delete/$1');
    });

    // Rental Status
    $routes->group('rental-status', ['namespace' => 'App\Controllers\Rental'], function($routes) {
        // Rental-Status
        $routes->get('/', 'RentalStatusController::index');
        $routes->get('detail/(:segment)', 'RentalStatusController::detail/$1');
        $routes->post('update', 'RentalStatusController::updateStatus');
        $routes->get('print/(:segment)', 'RentalStatusController::print/$1');
    });

    // User
    $routes->group('user', ['namespace' => 'App\Controllers\User'], function($routes) {
        $routes->get('/', 'UserController::index');
        $routes->post('store', 'UserController::store');
        $routes->get('delete/(:segment)', 'UserController::delete/$1');
    });

    // report
    $routes->group('report', ['namespace' => 'App\Controllers\Report'], function($routes) {
        $routes->get('/', 'ReportController::index');
        $routes->get('export-pdf', 'ReportController::exportPdf');
        $routes->get('export-excel', 'ReportController::exportExcel');
    });

    // Setting
    $routes->group('setting', ['namespace' => 'App\Controllers\Setting'], function($routes) {
        $routes->get('/', 'SettingController::index');
        $routes->post('save', 'SettingController::save');
    });


    // ======================================== //
    //               USER                      //
    // ======================================== //

    // Profile
    $routes->group('profile', ['namespace' => 'App\Controllers\User'], function($routes) {
        $routes->get('/', 'UserController::profile');
        $routes->post('update', 'UserController::updateProfile');
    });

    $routes->group('user', ['namespace' => 'App\Controllers\User'], function($routes) {
        $routes->get('transactions/', 'UserController::transaction');
    });

    $routes->group('user', ['namespace' => 'App\Controllers\Product'], function($routes) {
        // Users
        $routes->get('products-list', 'ProductController::productAll');
    });


    

});


