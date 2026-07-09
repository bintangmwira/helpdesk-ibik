<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('login/process', 'AuthController::loginProcess');
$routes->get('logout', 'AuthController::logout');

$routes->get('admin/dashboard', 'AdminController::dashboard');
$routes->post('admin/laporan/tanggapi/(:num)', 'AdminController::simpanTanggapan/$1');
$routes->post('admin/laporan/update-status/(:num)', 'AdminController::updateStatus/$1');

$routes->get('mahasiswa/dashboard', 'MahasiswaController::dashboard');
$routes->post('mahasiswa/laporan/simpan', 'MahasiswaController::simpanLaporan');
$routes->get('mahasiswa/laporan/tiket/(:num)', 'MahasiswaController::detailTiket/$1');
