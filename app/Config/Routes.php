<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/admin', 'Home::index', ['filter' => 'role:admin,karyawan,owner, login']);
$routes->get('/', 'Pelanggan::dashboard');
$routes->get('/deskripsi/(:num)', 'Pelanggan::deskripsi/$1');
$routes->post('/keranjang/(:num)', 'Pelanggan::keranjang/$1', ['filter' => 'login']);
$routes->get('/lihat_keranjang', 'Pelanggan::lihat_keranjang', ['filter' => 'login']);
$routes->get('/hapus_keranjang/(:any)', 'Pelanggan::hapus_keranjang/$1', ['filter' => 'login']);
$routes->post('/beli', 'Pelanggan::beli', ['filter' => 'login']);


$routes->get('/dataBarang', 'Barang::dataBarang', ['filter' => 'role:admin,owner,karyawan, login']);
$routes->get('/tambahBarang', 'Barang::tambahBarang', ['filter' => 'role:admin,owner, login']);
$routes->post('/simpanBarang', 'Barang::simpanBarang', ['filter' => 'role:admin,owner, login']);
$routes->get('/editBarang/(:num)', 'Barang::editBarang/$1', ['filter' => 'role:admin,owner, login']);
$routes->post('/ubahBarang/(:num)', 'Barang::ubahBarang/$1', ['filter' => 'role:admin,owner, login']);
$routes->delete('/hapusBarang/(:num)', 'Barang::hapusBarang/$1', ['filter' => 'role:admin,owner, login']);

$routes->get('/dataKaryawan', 'Karyawan::dataKaryawan', ['filter' => 'role:admin, login']);
$routes->get('/tambahKaryawan', 'Karyawan::tambahKaryawan', ['filter' => 'role:admin, login']);
$routes->post('/simpanKaryawan', 'Karyawan::simpanKaryawan', ['filter' => 'role:admin, login']);
$routes->get('/editKaryawan/(:num)', 'Karyawan::editKaryawan/$1', ['filter' => 'role:admin, login']);
$routes->post('/ubahKaryawan/(:num)', 'Karyawan::ubahKaryawan/$1', ['filter' => 'role:admin, login']);
$routes->delete('/hapusKaryawan/(:num)', 'Karyawan::hapusKaryawan/$1', ['filter' => 'role:admin, login']);

$routes->get('/dataTransaksi', 'Karyawan::dataTransaksi', ['filter' => 'role:admin,owner,karyawan, login']);

$routes->get('/dataPelanggan', 'Pelanggan::dataPelanggan', ['filter' => 'role:admin,karyawan']);

$routes->get('/dataMenu', 'Menu::dataMenu', ['filter' => 'role:admin, login']);
$routes->get('/tambahMenu', 'Menu::tambahMenu', ['filter' => 'role:admin, login']);
$routes->post('/simpanMenu', 'Menu::simpanMenu', ['filter' => 'role:admin, login']);
$routes->get('/editMenu/(:num)', 'Menu::editMenu/$1', ['filter' => 'role:admin, login']);
$routes->post('/ubahMenu/(:num)', 'Menu::ubahMenu/$1', ['filter' => 'role:admin, login']);
$routes->delete('/hapusMenu/(:num)', 'Menu::hapusMenu/$1', ['filter' => 'role:admin, login']);
$routes->post('/active/(:num)', 'Menu::active/$1', ['filter' => 'role:admin, login']);

$routes->get('notifications', 'NotificationController::getNotifications', ['filter' => 'role:admin, login']);
$routes->post('notifications/read/(:num)', 'NotificationController::markAsRead/$1', ['filter' => 'role:admin, login']);
$routes->get('notifications/detail/(:num)', 'NotificationController::getDetail/$1', ['filter' => 'role:admin, login']);
$routes->post('update-status/(:num)', 'Karyawan::updateStatus/$1', ['filter' => 'role:admin, login']);
$routes->post('batal-status/(:num)', 'Karyawan::batalStatus/$1', ['filter' => 'role:admin, login']);

