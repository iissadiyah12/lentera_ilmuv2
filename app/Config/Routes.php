<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin     = ['filter' => 'role:admin'];
$petugas     = ['filter' => 'role:petugas'];
$anggota     = ['filter' => 'role:anggota'];
$allRole   = ['filter' => 'role:admin, petugas, anggota'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

//USERS
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create'); // form tambah user
$routes->post('/users/store', 'Users::store'); // aksi simpan user
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole); // form edit user
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole); // aksi update user
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole); // aksi hapus user
$routes->get('users/detail/(:num)', 'Users::detail/$1', $allRole); // aksi detail user
$routes->get('users/print', 'Users::print', $allRole); // aksi print data user
$routes->get('users/wa/(:num)', 'Users::wa/$1', $allRole); // aksi kirim ke whatsapp

//BUKU
$routes->get('buku', 'Buku::index');
$routes->get('buku/create', 'Buku::create');
$routes->get('buku/detail/(:num)', 'Buku::detail/$1');
$routes->get('buku/edit/(:num)', 'Buku::edit/$1');
$routes->post('buku/update/(:num)', 'Buku::update/$1');
$routes->get('buku/delete/(:num)', 'Buku::delete/$1');
$routes->get('buku/print', 'Buku::print');
$routes->get('buku/wa/(:num)', 'Buku::wa/$1');
$routes->post('buku/store', 'Buku::store');
$routes->get('buku/baca/(:num)', 'Buku::baca/$1');

//RAK
$routes->get('/rak', 'Rak::index');
$routes->get('/rak/create','Rak::create');
$routes->post('/rak/save','Rak::save');
$routes->get('/rak/edit/(:num)','Rak::edit/$1');
$routes->post('/rak/update/(:num)','Rak::update/$1');
$routes->get('/rak/delete/(:num)','Rak::delete/$1');
$routes->get('rak/edit/(:num)', 'Rak::edit/$1');
$routes->post('rak/store', 'Rak::store');


//KATEGORI
$routes->get('/kategori', 'Kategori::index');
$routes->get('/kategori/create','Kategori::create');
$routes->post('/kategori/save','Kategori::save');
$routes->get('/kategori/edit/(:num)','Kategori::edit/$1');
$routes->post('/kategori/update/(:num)','Kategori::update/$1');
$routes->get('/kategori/delete/(:num)','Kategori::delete/$1');
$routes->get('kategori/edit/(:num)', 'Kategori::edit/$1');
$routes->post('/kategori/store','kategori::store');


//PENULIS
$routes->get('/penulis', 'Penulis::index');
$routes->get('/penulis/create','Penulis::create');
$routes->post('/penulis/store','penulis::store');
$routes->get('/penulis/edit/(:num)','Penulis::edit/$1');
$routes->post('/penulis/update/(:num)','Penulis::update/$1');
$routes->get('/penulis/delete/(:num)','Penulis::delete/$1');

//PENERBIT
$routes->get('/penerbit', 'Penerbit::index');
$routes->get('/penerbit/create','Penerbit::create');
$routes->post('/penerbit/store','Penerbit::store');
$routes->get('/penerbit/edit/(:num)','Penerbit::edit/$1');
$routes->post('/penerbit/update/(:num)','Penerbit::update/$1');
$routes->get('/penerbit/delete/(:num)','Penerbit::delete/$1');

//PEMINJAMAN
$routes->get('peminjaman', 'Peminjaman::index');
$routes->get('peminjaman/create', 'Peminjaman::create');
$routes->post('peminjaman/store', 'Peminjaman::store');
$routes->get('peminjaman/delete/(:num)', 'Peminjaman::delete/$1');
$routes->get('buku/wa/(:num)', 'Buku::wa/$1');
$routes->get('peminjaman/detail/(:num)', 'Peminjaman::detail/$1');
$routes->get('peminjaman/perpanjang/(:num)/(:num)', 'Peminjaman::perpanjang/$1/$2');
$routes->get('peminjaman/kembalikan/(:num)', 'Peminjaman::kembalikan/$1');
$routes->get('peminjaman/edit/(:num)', 'Peminjaman::edit/$1');
$routes->post('peminjaman/update/(:num)', 'Peminjaman::update/$1');

// PETUGAS
$routes->get('petugas', 'Petugas::index');
$routes->get('petugas/create', 'Petugas::create');
$routes->post('petugas/store', 'Petugas::store');
$routes->get('petugas/edit/(:num)', 'Petugas::edit/$1');
$routes->post('petugas/update/(:num)', 'Petugas::update/$1');
$routes->get('petugas/delete/(:num)', 'Petugas::delete/$1');

//PENGEMBALIAN
$routes->get('pengembalian', 'Pengembalian::index');
$routes->get('pengembalian/create', 'Pengembalian::create');
$routes->post('pengembalian/store', 'Pengembalian::store');
$routes->get('pengembalian/delete/(:num)', 'Pengembalian::delete/$1');


$routes->get('/backup', 'Backup::index');

$routes->get('/restore', 'Restore::index');
$routes->post('/restore/auth', 'Restore::auth');
$routes->get('/restore/form', 'Restore::form');
$routes->post('/restore/process', 'Restore::process');