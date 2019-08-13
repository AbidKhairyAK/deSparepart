<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/beranda', 'BerandaController@index')->name('beranda.index');
Route::redirect('/', '/beranda');

Route::get('/barang/multiedit', 'BarangController@multiedit');

Route::resource('/pembelian', 'PembelianController');
Route::resource('/penjualan', 'PenjualanController');
Route::resource('/hutang', 'HutangController');
Route::resource('/piutang', 'PiutangController');
Route::resource('/pembayaran-hutang', 'PembayaranHutangController');
Route::resource('/pembayaran-piutang', 'PembayaranPiutangController');
Route::resource('/pemasok', 'PemasokController');
Route::resource('/pemasok', 'PemasokController');
Route::resource('/pelanggan', 'PelangganController');
Route::resource('/barang', 'BarangController');
Route::resource('/karyawan', 'KaryawanController');
Route::resource('/pengguna', 'PenggunaController');
Route::resource('/penjual', 'PenjualController');
Route::resource('/mobil', 'MobilController');
Route::resource('/komponen', 'KomponenController');
Route::resource('/jabatan', 'JabatanController');
Route::resource('/enkripsi', 'EnkripsiController');
Route::resource('/backup', 'BackupController');

Route::get('/laporan-penjualan', 'LaporanPenjualanController@index')->name('laporan-penjualan.index');
Route::get('/laporan-pembelian', 'LaporanPembelianController@index')->name('laporan-pembelian.index');
Route::get('/laporan-kinerja-karyawan', 'LaporanKinerjaKaryawanController@index')->name('laporan-kinerja-karyawan.index');
Route::get('/laporan-laba-rugi', 'LaporanLabaRugiController@index')->name('laporan-laba-rugi.index');