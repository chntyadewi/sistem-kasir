<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['auth'] = 'auth/index';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

// Admin routes
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard/index';
$route['admin/produk'] = 'admin/produk/index';
$route['admin/produk/create'] = 'admin/produk/create';
$route['admin/produk/edit/(:id)'] = 'admin/produk/edit/$1';
$route['admin/produk/delete/(:id)'] = 'admin/produk/delete/$1';

// Kategori routes
$route['admin/kategori'] = 'admin/kategori/index';
$route['admin/kategori/create'] = 'admin/kategori/create';
$route['admin/kategori/edit/(:num)'] = 'admin/kategori/edit/$1';
$route['admin/kategori/delete/(:num)'] = 'admin/kategori/delete/$1';

// Produk routes
$route['admin/produk'] = 'admin/produk/index';
$route['admin/produk/create'] = 'admin/produk/create';
$route['admin/produk/edit/(:num)'] = 'admin/produk/edit/$1';
$route['admin/produk/delete/(:num)'] = 'admin/produk/delete/$1';

// Pengguna routes
$route['admin/pengguna'] = 'admin/pengguna/index';
$route['admin/pengguna/create'] = 'admin/pengguna/create';
$route['admin/pengguna/edit/(:num)'] = 'admin/pengguna/edit/$1';
$route['admin/pengguna/delete/(:num)'] = 'admin/pengguna/delete/$1';

// Penjualan routes
$route['admin/penjualan'] = 'admin/penjualan/index';
$route['admin/penjualan/create'] = 'admin/penjualan/create';
$route['admin/penjualan/view/(:num)'] = 'admin/penjualan/view/$1';
$route['admin/penjualan/delete/(:num)'] = 'admin/penjualan/delete/$1';

// Transaksi routes
$route['admin/transaksi'] = 'admin/transaksi/index';
$route['admin/transaksi/process'] = 'admin/transaksi/process';
$route['admin/transaksi/struk/(:num)'] = 'admin/transaksi/struk/$1';


// apiiii
$route['api/pengguna']['GET'] = 'api/pengguna';
$route['api/pengguna/(:num)']['GET'] = 'api/pengguna/detail/$1';
$route['api/pengguna']['POST'] = 'api/pengguna/tambah';
$route['api/pengguna/(:num)']['PUT'] = 'api/pengguna/ubah/$1';
$route['api/pengguna/(:num)']['DELETE'] = 'api/pengguna/hapus/$1';

$route['api/pengguna/login']['post'] = 'api/pengguna/login';

$route['api/produk/hapus/(:num)'] = 'api/produk/hapus/$1';
$route['api/kategori'] = 'api/kategori/index';

//detail penjualan
$route['detail_penjualan']['GET'] = 'detail_penjualan/index';
$route['detail_penjualan/(:num)']['GET'] = 'detail_penjualan/index/$1';
$route['detail_penjualan']['POST'] = 'detail_penjualan/index';
$route['detail_penjualan/(:num)']['PUT'] = 'detail_penjualan/index/$1';
$route['detail_penjualan/(:num)']['DELETE'] = 'detail_penjualan/index/$1';

$route['admin/profile'] = 'admin/profile';
$route['kasir/profile'] = 'kasir/profile'; // atau ke controller Profile langsung






