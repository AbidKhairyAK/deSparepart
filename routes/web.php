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

//real routes
Route::group(['middleware' => ['guest']], function () {
	Route::get('login', 'AuthController@loginForm')->name('login');
	Route::post('login', 'AuthController@login')->name('login');
});
Route::post('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {

	Route::get('pengguna/data', 'PenggunaController@data')->name('pengguna.data');
	Route::get('pengguna/{id}/activate', 'PenggunaController@activate')->name('pengguna.activate');
	Route::get('pengguna/{id}/deactivate', 'PenggunaController@deactivate')->name('pengguna.deactivate');
	Route::resource('pengguna', 'PenggunaController');

	Route::get('customer/api', 'CustomerController@api')->name('customer.api');
	Route::get('customer/data', 'CustomerController@data')->name('customer.data');
	Route::get('customer/{id}/activate', 'CustomerController@activate')->name('customer.activate');
	Route::get('customer/{id}/deactivate', 'CustomerController@deactivate')->name('customer.deactivate');
	Route::resource('customer', 'CustomerController');

	Route::get('hak-akses/data', 'HakAksesController@data')->name('hak-akses.data');
	Route::resource('/hak-akses', 'HakAksesController');

	Route::get('komponen/api', 'KomponenController@api')->name('komponen.api');
	Route::get('komponen/data', 'KomponenController@data')->name('komponen.data');
	Route::resource('/komponen', 'KomponenController');

	Route::get('kendaraan/api', 'KendaraanController@api')->name('kendaraan.api');
	Route::get('kendaraan/data', 'KendaraanController@data')->name('kendaraan.data');
	Route::resource('/kendaraan', 'KendaraanController');

	Route::get('satuan/api', 'SatuanController@api')->name('satuan.api');

	Route::get('barang/api', 'BarangController@api')->name('barang.api');
	Route::get('barang/data', 'BarangController@data')->name('barang.data');
	Route::resource('/barang', 'BarangController');

	Route::get('penjualan/{id}/cetak', 'PenjualanController@cetak')->name('penjualan.cetak');
	Route::get('penjualan/api/{type?}', 'PenjualanController@api')->name('penjualan.api');
	Route::get('penjualan/data', 'PenjualanController@data')->name('penjualan.data');
	Route::resource('/penjualan', 'PenjualanController');

	Route::get('piutang/data', 'PiutangController@data')->name('piutang.data');
	Route::resource('/piutang', 'PiutangController');

	Route::get('/pembayaran-piutang/data', 'PembayaranPiutangController@data')->name('pembayaran-piutang.data');
	Route::resource('/pembayaran-piutang', 'PembayaranPiutangController');

	Route::get('retur-penjualan/data/{type}', 'ReturPenjualanController@data')->name('retur-penjualan.data');
	Route::resource('/retur-penjualan', 'ReturPenjualanController');

	// testing routes
	Route::get('/beranda', 'BerandaController@index')->name('beranda.index');
	Route::redirect('/', '/beranda');

	Route::get('/barang/multiedit', 'BarangController@multiedit');

	Route::resource('/pembelian', 'PembelianController');
	Route::resource('/hutang', 'HutangController');
	Route::resource('/pembayaran-hutang', 'PembayaranHutangController');
	Route::resource('/supplier', 'SupplierController');
	Route::resource('/barang', 'BarangController');
	Route::resource('/karyawan', 'KaryawanController');
	// Route::resource('/pengguna', 'PenggunaController');
	Route::resource('/penjual', 'PenjualController');
	Route::resource('/jabatan', 'JabatanController');
	Route::resource('/enkripsi', 'EnkripsiController');
	Route::resource('/backup', 'BackupController');

	Route::get('/laporan-penjualan', 'LaporanPenjualanController@index')->name('laporan-penjualan.index');
	Route::get('/laporan-pembelian', 'LaporanPembelianController@index')->name('laporan-pembelian.index');
	Route::get('/laporan-kinerja-karyawan', 'LaporanKinerjaKaryawanController@index')->name('laporan-kinerja-karyawan.index');
	Route::get('/laporan-laba-rugi', 'LaporanLabaRugiController@index')->name('laporan-laba-rugi.index');
});

