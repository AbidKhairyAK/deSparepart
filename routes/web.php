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

	Route::get('supplier/api', 'SupplierController@api')->name('supplier.api');
	Route::get('supplier/data', 'SupplierController@data')->name('supplier.data');
	Route::get('supplier/{id}/activate', 'SupplierController@activate')->name('supplier.activate');
	Route::get('supplier/{id}/deactivate', 'SupplierController@deactivate')->name('supplier.deactivate');
	Route::resource('supplier', 'SupplierController');

	Route::get('hak-akses/data', 'HakAksesController@data')->name('hak-akses.data');
	Route::resource('/hak-akses', 'HakAksesController');

	Route::get('komponen/api', 'KomponenController@api')->name('komponen.api');
	Route::get('komponen/data', 'KomponenController@data')->name('komponen.data');
	Route::resource('/komponen', 'KomponenController');

	Route::get('kendaraan/api', 'KendaraanController@api')->name('kendaraan.api');
	Route::get('kendaraan/data', 'KendaraanController@data')->name('kendaraan.data');
	Route::resource('/kendaraan', 'KendaraanController');

	Route::get('satuan/api', 'SatuanController@api')->name('satuan.api');

	Route::get('barang/cetak', 'BarangController@cetak')->name('barang.cetak');
	Route::get('barang/api', 'BarangController@api')->name('barang.api');
	Route::get('barang/data', 'BarangController@data')->name('barang.data');
	Route::resource('/barang', 'BarangController');

	Route::get('penjualan/{id}/cetak', 'PenjualanController@cetak')->name('penjualan.cetak');
	Route::get('penjualan/api/{type?}', 'PenjualanController@api')->name('penjualan.api');
	Route::get('penjualan/data', 'PenjualanController@data')->name('penjualan.data');
	Route::resource('/penjualan', 'PenjualanController');

	Route::get('pembelian/api/{type?}', 'PembelianController@api')->name('pembelian.api');
	Route::get('pembelian/data', 'PembelianController@data')->name('pembelian.data');
	Route::resource('/pembelian', 'PembelianController');

	Route::get('piutang/data', 'PiutangController@data')->name('piutang.data');
	Route::resource('/piutang', 'PiutangController');

	Route::get('hutang/data', 'HutangController@data')->name('hutang.data');
	Route::resource('/hutang', 'HutangController');

	Route::get('/pembayaran-piutang/data', 'PembayaranPiutangController@data')->name('pembayaran-piutang.data');
	Route::resource('/pembayaran-piutang', 'PembayaranPiutangController');

	Route::get('/pembayaran-hutang/data', 'PembayaranHutangController@data')->name('pembayaran-hutang.data');
	Route::resource('/pembayaran-hutang', 'PembayaranHutangController');

	Route::get('retur-penjualan/data', 'ReturPenjualanController@data')->name('retur-penjualan.data');
	Route::get('retur-penjualan/{id}/cetak', 'ReturPenjualanController@cetak')->name('retur-penjualan.cetak');
	Route::resource('/retur-penjualan', 'ReturPenjualanController');

	Route::get('retur-pembelian/data', 'ReturPembelianController@data')->name('retur-pembelian.data');
	Route::resource('/retur-pembelian', 'ReturPembelianController');

	// testing routes
	Route::get('/beranda', 'BerandaController@index')->name('beranda.index');
	Route::redirect('/', '/beranda');

	Route::get('/barang/multiedit', 'BarangController@multiedit');

	Route::get('karyawan/data', 'KaryawanController@data')->name('karyawan.data');
	Route::resource('/karyawan', 'KaryawanController');
	// Route::resource('/pengguna', 'PenggunaController');
	Route::resource('/penjual', 'PenjualController');

	Route::get('jabatan/data', 'JabatanController@data')->name('jabatan.data');
	Route::resource('/jabatan', 'JabatanController');

	Route::resource('/enkripsi', 'EnkripsiController');
	Route::resource('/backup', 'BackupController');

	Route::get('/laporan-penjualan', 'LaporanPenjualanController@index')->name('laporan-penjualan.index');
	Route::get('/laporan-pembelian', 'LaporanPembelianController@index')->name('laporan-pembelian.index');
	Route::get('/laporan-kinerja-karyawan', 'LaporanKinerjaKaryawanController@index')->name('laporan-kinerja-karyawan.index');
	Route::get('/laporan-laba-rugi', 'LaporanLabaRugiController@index')->name('laporan-laba-rugi.index');

	Route::get('history/data', 'HistoryController@data')->name('history.data');
	Route::get('history/{id}', 'HistoryController@show')->name('history.show');
	Route::get('history', 'HistoryController@index')->name('history.index');
});
