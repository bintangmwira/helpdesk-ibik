<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('login/process', 'AuthController::loginProcess');
$routes->get('logout', 'AuthController::logout');

$routes->get('admin/dashboard', 'AdminController::dashboard');
$routes->get('mahasiswa/dashboard', 'MahasiswaController::dashboard');
