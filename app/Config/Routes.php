<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/galeri', 'Home::galeri');
$routes->get('/detail-product', 'Home::detailProduct');

$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::registerProses');
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::loginProses');
// Logout
$routes->get('/logout', 'Auth\AuthController::logout');


$routes->get('/dashboard', 'Dashboard\DashboardController::index');

// category
$routes->get('/category', 'Category\CategoryController::index');