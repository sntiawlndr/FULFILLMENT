<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ExcelController;

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
// test
//Product
Route::get('/home','HomeController@index');
Route::get('/dashboard','HomeController@dashboard');
Route::get('/product/add','ProductController@index');
Route::post('/product/save','ProductController@product_save');
Route::get('/product','ProductController@product_show');
Route::get('/product/edit/{id}','ProductController@product_edit');
Route::get('/product/delete/{id}','ProductController@product_delete');
Route::post('/product/update','ProductController@product_update');
Route::post('/product/datatable','ProductController@product_datatable');
Route::get('/product/get/{id}','ProductController@product_get');

//Category

Route::get('/category/add', 'CategoryController@index')->name('admin.home')->middleware('admin');
Route::post('/category/save', 'CategoryController@category_save')->name('admin.home')->middleware('admin');
Route::get('/category', 'CategoryController@category_show')->name('admin.home')->middleware('admin');
Route::get('/category/edit/{id}', 'CategoryController@category_edit')->name('admin.home')->middleware('admin');
Route::get('/category/delete/{id}', 'CategoryController@category_delete')->name('admin.home')->middleware('admin');
Route::post('/category/update', 'CategoryController@category_update')->name('admin.home')->middleware('admin');
Route::post('/category/datatable', 'CategoryController@category_datatable')->name('admin.home')->middleware('admin');
Route::get('/category/get/{id}', 'CategoryController@category_get')->name('admin.home')->middleware('admin');
Route::get('categoryal', ['uses'=>'CategoryController@fildown', 'as'=>'category.fildown']);


//Barang
Route::get('/barang/upload', 'BarangController@upload_show')->name('admin.home')->middleware('admin');
Route::get('/barang/add', 'BarangController@index')->middleware('admin');
Route::post('/barang/save', 'BarangController@barang_save');
Route::get('/barang', 'BarangController@barang_show')->middleware('admin');
Route::get('/detail', 'BarangController@detail')->middleware('admin');
Route::get('/barang/edit/{id}', 'BarangController@barang_edit')->middleware('admin');
Route::get('/barang/delete/{id}', 'BarangController@barang_delete')->middleware('admin');
Route::post('/barang/update', 'BarangController@barang_update')->middleware('admin');
Route::post('/barang/datatable', 'BarangController@barang_datatable')->middleware('admin');
Route::post('/detail/datatable', 'BarangController@detail_datatable')->middleware('admin');
Route::get('/barang/detail/{id}', 'BarangController@barang_detail')->middleware('admin');
Route::post('/form', 'BarangController@form_datatable')->middleware('admin');
Route::get('/barang/get/{id}', 'BarangController@barang_get')->middleware('admin');
Route::get('/barang/print/{id}', 'BarangController@barang_print')->middleware('admin');
Route::post('/upload/proses', 'BarangController@import_data')->middleware('admin');
Route::GET('/printbar', 'BarangController@printbar')->name('printbar')->middleware('admin');

//gudang
Route::get('/gudang/add', 'GudangController@index')->middleware('admin');
Route::post('/gudang/save', 'GudangController@gudang_save')->middleware('admin');
Route::get('/gudang', 'GudangController@gudang_show')->middleware('admin');
Route::get('/gudang/edit/{id}', 'GudangController@gudang_edit')->middleware('admin');
Route::get('/gudang/delete/{id}', 'GudangController@gudang_delete')->middleware('admin');
Route::post('/gudang/update', 'GudangController@gudang_update')->middleware('admin');
Route::post('/gudang/datatable', 'GudangController@gudang_datatable')->middleware('admin');
Route::get('/gudang/get/{id}', 'GudangController@gudang_get')->middleware('admin');
Route::post('gudang/getkecamatan','GudangController@get_kecamatan')->middleware('admin');


//pindah gudang
Route::get('/pindah/add', 'PindahController@index')->middleware('admin');
Route::post('/pindah/save', 'PindahController@pindah_save')->middleware('admin');
Route::get('/pindah', 'PindahController@pindah_show')->middleware('admin');
Route::get('/pindah/edit/{id}', 'PindahController@pindah_edit')->middleware('admin');
Route::post('/pindah/update', 'PindahController@pindah_update')->middleware('admin');
Route::post('/pindah/datatable', 'PindahController@pindah_datatable')->middleware('admin');
Route::get('/pindah/get/{id}', 'PindahController@pindah_get')->middleware('admin');
Route::get('/tpg/show', 'PindahController@tpg_show')->middleware('admin');
Route::post('/tpg/datatable', 'PindahController@tpg_datatable')->middleware('admin');





// Seller
// Route::get('/home', 'HomeController@index');
Route::get('/seller/add', 'SellerController@index')->middleware('admin');
Route::post('/seller/save', 'SellerController@seller_save')->middleware('admin');
Route::get('/seller', 'SellerController@seller_show')->middleware('admin');
Route::get('/seller/edit/{id}', 'SellerController@seller_edit')->middleware('admin');
Route::get('/seller/delete/{id}', 'SellerController@seller_delete')->middleware('admin');
Route::post('/seller/update', 'SellerController@seller_update')->middleware('admin');
Route::post('/seller/datatable', 'SellerController@seller_datatable')->middleware('admin');
Route::get('/seller/get/{id}', 'SellerController@seller_get')->middleware('admin');
// Route::get('/ganti/show', 'SellerController@ganti_show');
Route::get('/seller/gantipw/{id}', 'SellerController@ganti_password')->middleware('admin');
Route::post('/seller/updatepw', 'SellerController@update_password')->middleware('admin');

// Seller Invoice

Route::get('/invoice/add','InvoiceController@index')->middleware('admin');
Route::post('/invoice/save','InvoiceController@invoice_save')->middleware('admin');
Route::get('/invoice','InvoiceController@invoice_show')->middleware('admin');
Route::get('/invoice/edit/{id}','InvoiceController@invoice_edit')->middleware('admin');
Route::get('/invoice/delete/{id}','InvoiceController@invoice_delete')->middleware('admin');
Route::post('/invoice/update','InvoiceController@invoice_update')->middleware('admin');
Route::post('/invoice/datatable','InvoiceController@invoice_datatable')->middleware('admin');
Route::get('/invoice/get/{id}','InvoiceController@invoice_get')->middleware('admin');
Route::get('/bayar/show', 'InvoiceController@bayar_show')->middleware('admin');
Route::post('/detail/data','InvoiceController@detail_data')->middleware('admin');
Route::post('/detail/datatable','InvoiceController@detail_datatable')->middleware('admin');

//Daftar Barang Baru
Route::get('/baru','TerimabarangbaruController@baru_show')->middleware('admin');
Route::get('/baru/print/{id}','TerimabarangbaruController@baru_print')->middleware('admin');
Route::post('/baru/scan/','TerimabarangbaruController@bttn_scan')->middleware('admin');
Route::post('/baru/datatable','TerimabarangbaruController@baru_datatable')->middleware('admin');

//Terima Barang Baru Detail
Route::get('/tbb/show','TerimabarangbaruController@tbb_show')->middleware('admin');
Route::post('/tbb/datatable','TerimabarangbaruController@tbb_datatable')->middleware('admin');
Route::post('/tbb/save', 'TerimabarangbaruController@tbb_save')->middleware('admin');
Route::post('/tbb/batal', 'TerimabarangbaruController@bttn_btl')->middleware('admin');
Route::get('/tbb/invoice/{id}', 'TerimabarangbaruController@tbb_invoice')->middleware('admin');
Route::get('/terima/baru/{id}', 'TerimabarangbaruController@terima_baru')->middleware('admin');

//Terima Barang Baru Summary
Route::get('/summary/show','TerimabarangbaruController@summary_show')->middleware('admin');
Route::post('/summary/datatable','TerimabarangbaruController@summary_datatable')->middleware('admin');

//Daftar Barang Lama
Route::get('/lama','TerimabaranglamaController@lama_show')->middleware('admin');
Route::post('/lama/datatable','TerimabaranglamaController@lama_datatable')->middleware('admin');
//Terima Barang Lama
Route::get('/tbl/show','TerimabaranglamaController@tbl_show')->middleware('admin');
Route::post('/tbl/datatable','TerimabaranglamaController@tbl_datatable')->middleware('admin');
Route::post('/tbl/save', 'TerimabaranglamaController@tbl_save')->middleware('admin');
Route::post('/tbl/update', 'TerimabaranglamaController@tbl_update')->middleware('admin');
Route::get('/tbl/invoice/{id}', 'TerimabaranglamaController@tbl_invoice')->middleware('admin');
Route::get('/tbl/batal/{id}', 'TerimabaranglamaController@bttn_tbl')->middleware('admin');
Route::get('/terima/lama/{id}', 'TerimabaranglamaController@terima_lama')->middleware('admin');


//Keluar Barang
Route::get('/keluar','KeluarbarangController@keluar_show')->middleware('admin');
Route::post('/keluar/datatable','KeluarbarangController@keluar_datatable')->middleware('admin');
Route::get('/keluar/get','KeluarbarangController@keluar_detail')->middleware('admin');
//Detail Keluar Barang
Route::get('/detail/keluar','KeluarbarangController@detail_keluar_show')->middleware('admin');
Route::post('/detail/keluar/datatable','KeluarbarangController@detail_keluar_datatable')->middleware('admin');
//Proses Keluar Barang
Route::post('/proses/keluar','KeluarbarangController@proses_keluar_show')->middleware('admin');
Route::post('/proses/keluar/datatable','KeluarbarangController@proses_keluar_datatable')->middleware('admin');
Route::get('/proses/get','KeluarbarangController@proses_get');
Route::get('/proses/k','KeluarbarangController@proses_k');
//Role
Route::get('/grole/add', 'GroleController@index')->middleware('admin');
Route::post('/grole/save', 'GroleController@grole_save')->middleware('admin');
Route::get('/grole', 'GroleController@grole_show')->middleware('admin');
Route::get('/grole/edit/{id}', 'GroleController@grole_edit')->middleware('admin');
Route::get('/grole/delete/{id}', 'GroleController@grole_delete')->middleware('admin');
Route::post('/grole/update', 'GroleController@grole_update')->middleware('admin');
Route::post('/grole/datatable', 'GroleController@grole_datatable')->middleware('admin');
Route::get('/grole/get/{id}', 'GroleController@grole_get')->middleware('admin');
Route::get('/grole/suspend/{id}', 'GroleController@grole_suspend')->middleware('admin');
Route::get('/grole/unsuspend/{id}', 'GroleController@grole_unsuspend')->middleware('admin');


//User

Route::get('/user/add', 'FmUserController@index')->middleware('admin');
Route::post('/user/save', 'FmUserController@user_save')->middleware('admin');
Route::get('/user', 'FmUserController@user_show')->middleware('admin');
Route::post('/user/datatable', 'FmUserController@user_datatable')->middleware('admin');
Route::get('/user/get/{id}', 'FmUserController@user_get')->middleware('admin');
Route::get('/user/delete/{id}', 'FmUserController@user_delete')->middleware('admin');
Route::get('/user/edit/{id}', 'FmUserController@user_edit')->middleware('admin');
Route::post('/user/update', 'FmUserController@user_update')->middleware('admin');

//Seller Barang
Route::get('/selbrg/upload','SellerbarangController@upload_show')->middleware('user');
Route::get('/selbrg/add','SellerbarangController@index')->middleware('user');
Route::post('/selbrg/save','SellerbarangController@seller_save')->middleware('user');
Route::get('/selbrg','SellerbarangController@seller_show')->middleware('user');
Route::get('/selbrg/edit/{id}','SellerbarangController@selbrg_edit')->middleware('user');
Route::get('/selbrgdetail/{id}','SellerbarangController@selbrgdetail')->middleware('user');
Route::get('/selbrg/delete/{id}','SellerbarangController@seller_delete')->middleware('user');
Route::post('/selbrg/update','SellerbarangController@seller_update')->middleware('user');
Route::post('/selbrg/datatable','SellerbarangController@seller_datatable')->middleware('user');
Route::post('/seldetail/datatable','SellerbarangController@seldetail_datatable')->middleware('user');
Route::get('/selbrg/detail','SellerbarangController@seldetail_show')->middleware('user');
Route::get('/detailselbrg/{id}','SellerbarangController@detail_selbrg')->middleware('user');
Route::get('/selbrg/get/{id}','SellerbarangController@seller_get')->middleware('user');
Route::get('/selbrg/print/{id}','SellerbarangController@seller_print')->middleware('user');
Route::post('/selbrg/proses', 'SellerbarangController@import_data')->middleware('user');
Route::post('/selbrgImport', 'SelbrgExcelController@importExcelSelbrg')->middleware('user')->name('selbrgImport');
//packing
Route::get('/packing','PackingController@packing_show')->middleware('admin');
Route::post('/packing/datatable','PackingController@packing_datatable')->middleware('admin');
Route::post('/packing/data','PackingController@packing_data')->middleware('admin');

// Seller Invoice

Route::get('/invoiceseller/add','InvoiceController@index')->middleware('user');
Route::post('/invoiceseller/save','InvoiceController@invoice_save')->middleware('user');
Route::get('/invoiceseller','InvoiceController@invoice_show')->middleware('user');
Route::get('/invoiceseller/edit/{id}','InvoiceController@invoice_edit')->middleware('user');
Route::get('/invoice/delete/{id}','InvoiceController@invoice_delete')->middleware('user');
Route::post('/invoice/update','InvoiceController@invoice_update')->middleware('user');
Route::post('/invoice/datatable','InvoiceController@invoice_datatable')->middleware('user');
Route::get('/invoice/get/{id}','InvoiceController@invoice_get')->middleware('user');
Route::get('/bayar/show', 'InvoiceController@bayar_show')->middleware('user');
Route::post('/detail/data','InvoiceController@detail_data')->middleware('user');
Route::post('/detail/datatable','InvoiceController@detail_datatable')->middleware('user');

#module
Route::post('/select2/get-raw', 'ModuleController@select2_get_raw');
Route::get('/select2-group/get-like/{query?}', 'ModuleController@select2_get_like');
#module

//Import CSV
Route::get('/importExportView', 'MyController@importExportView');
Route::get('/export', 'MyController@export');
Route::post('/import', 'MyController@import');

//stok kartu
//  Route::get('/gudang/add', 'GudangController@index');
// Route::post('/gudang/save', 'GudangController@gudang_save');
Route::get('/kartu', 'KartuController@Kartu_show')->name('admin.home')->middleware('admin');
Route::get('/edit', 'KartuController@edit')->middleware('admin');
// Route::get('/gudang/delete/{id}', 'GudangController@gudang_delete');
// Route::post('/gudang/update', 'GudangController@gudang_update');
Route::post('/kartu/datatable', 'KartuController@kartu_datatable')->middleware('admin');
Route::get('/kartu/detail/{id}', 'KartuController@kartu_detail')->middleware('admin');
Route::post('/detail/datatable', 'KartuController@detail_datatable')->middleware('admin');
Route::post('/edit/datatable', 'KartuController@edit_datatable')->middleware('admin');

//Admin Profile
Route::get('/profile/detail', 'ProfileAdmController@profile_detail')->name('admin.home')->middleware('admin');

Route::get('/profile','ProfileAdmController@index')->name('admin.home')->middleware('admin');

//Seller Profile
Route::get('/sellerprofil/detail', 'ProfilSellerController@profile_detail')->middleware('user');

Route::get('/sellerprofil','ProfilSellerController@index')->middleware('user');

//pinjam
Route::get('/pinjam/add', 'PinjamController@index')->middleware('user');
Route::post('/pinjam/save', 'PinjamController@pinjam_save')->middleware('user');
Route::get('/pinjam', 'PinjamController@pinjam_show')->middleware('user');
Route::get('/pinjam/edit/{id}', 'PinjamController@pinjam_edit')->middleware('user');
Route::get('/pinjam/detail/{id}', 'PinjamController@pinjam_detail')->middleware('user');
Route::post('/pinjam/update', 'PinjamController@pinjam_update')->middleware('user');
Route::post('/pinjam/datatable', 'PinjamController@pinjam_datatable')->middleware('user');
Route::get('/pinjam/get/{id}', 'PinjamController@pinjam_get')->middleware('user');

//Transaksi Penjualan Seller
Route::get('/transaksi','PenjualanController@transaksi_show')->middleware('user');
Route::post('/transaksi/datatable','PenjualanController@transaksi_datatable')->middleware('user');
Route::get('/transaksi/ubah/{id}','PenjualanController@transaksi_ubah')->middleware('user');
Route::get('/transaksi/tanpaedit/{id}','PenjualanController@transaksi_tanpaedit')->middleware('user');
Route::get('/transaksi/edit/{id}','PenjualanController@transaksi_edit')->middleware('user');
Route::post('/transaksi/update','PenjualanController@transaksi_update')->middleware('user');
Route::get('/transaksi/get/{id}', 'PenjualanController@transaksi_get')->middleware('user');

//Route Import Excel
Route::get('importExportView', [ExcelController::class, 'importExportView'])->name('importExportView');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('exportExcel/{type}', [ExcelController::class, 'exportExcel'])->name('exportExcel');
// Route for import excel data to database.
Route::post('importExcel', [ExcelController::class, 'importExcel'])->name('importExcel');
//Login



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('user');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Login Seller
// Route::get('/loginsel','LoginselController@login')->name('login');
// Route::post('actionlogin', 'LoginselController@actionlogin')->name('actionlogin');

// Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//Login Multi Cara benar di Latihan
// Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function () {
//     Route::get('dashboard', 'DashboardController@index')->name('dashboard');
// });

Route::group(['as'=>'user.','prefix' => 'user','namespace'=>'User','middleware'=>['auth','user']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

//
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('admin');
Route::get('/logout','HomeController@logout');
