<?php

use Illuminate\Support\Facades\Route;

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
//Product
Route::get('/home', 'HomeController@index');
Route::get('/product/add', 'ProductController@index');
Route::post('/product/save', 'ProductController@product_save');
Route::get('/product', 'ProductController@product_show');
Route::get('/product/edit/{id}', 'ProductController@product_edit');
Route::get('/product/delete/{id}', 'ProductController@product_delete');
Route::post('/product/update', 'ProductController@product_update');
Route::post('/product/datatable', 'ProductController@product_datatable');
Route::get('/product/get/{id}', 'ProductController@product_get');

//Category

Route::get('/category/add', 'CategoryController@index');
Route::post('/category/save', 'CategoryController@category_save');
Route::get('/category', 'CategoryController@category_show');
Route::get('/category/edit/{id}', 'CategoryController@category_edit');
Route::get('/category/delete/{id}', 'CategoryController@category_delete');
Route::post('/category/update', 'CategoryController@category_update');
Route::post('/category/datatable', 'CategoryController@category_datatable');
Route::get('/category/get/{id}', 'CategoryController@category_get');

//Barang
Route::get('/barang/upload', 'BarangController@upload_show');
Route::get('/barang/add', 'BarangController@index');
Route::post('/barang/save', 'BarangController@barang_save');
Route::get('/barang', 'BarangController@barang_show');
Route::get('/barang/edit/{id}', 'BarangController@barang_edit');
Route::get('/barang/delete/{id}', 'BarangController@barang_delete');
Route::post('/barang/update', 'BarangController@barang_update');
Route::post('/barang/datatable', 'BarangController@barang_datatable');
Route::get('/barang/get/{id}', 'BarangController@barang_get');
Route::get('/barang/print/{id}', 'BarangController@barang_print');
Route::post('/upload/proses', 'BarangController@import_data');

//gudang
Route::get('/gudang/add', 'GudangController@index');
Route::post('/gudang/save', 'GudangController@gudang_save');
Route::get('/gudang', 'GudangController@gudang_show');
Route::get('/gudang/edit/{id}', 'GudangController@gudang_edit');
Route::get('/gudang/delete/{id}', 'GudangController@gudang_delete');
Route::post('/gudang/update', 'GudangController@gudang_update');
Route::post('/gudang/datatable', 'GudangController@gudang_datatable');
Route::get('/gudang/get/{id}', 'GudangController@gudang_get');

//pindah gudang
Route::get('/pindah/add', 'PindahController@index');
Route::post('/pindah/save', 'PindahController@pindah_save');
Route::get('/pindah', 'PindahController@pindah_show');
Route::get('/pindah/edit/{id}', 'PindahController@pindah_edit');
Route::get('/pindah/delete/{id}', 'PindahController@pindah_delete');
Route::post('/pindah/update', 'PindahController@pindahupdate');
Route::post('/pindah/datatable', 'PindahController@pindah_datatable');
Route::get('/pindah/detail/{id}', 'PindahController@pindah_get');





// Seller
Route::get('/home', 'HomeController@index');
Route::get('/seller/add', 'SellerController@index');
Route::post('/seller/save', 'SellerController@seller_save');
Route::get('/seller', 'SellerController@seller_show');
Route::get('/seller/edit/{id}', 'SellerController@seller_edit');
Route::get('/seller/delete/{id}', 'SellerController@seller_delete');
Route::post('/seller/update', 'SellerController@seller_update');
Route::post('/seller/datatable', 'SellerController@seller_datatable');
Route::get('/seller/get/{id}', 'SellerController@seller_get');

// Seller Invoice

Route::get('/home','HomeController@index');
Route::get('/invoice/add','InvoiceController@index');
Route::post('/invoice/save','InvoiceController@invoice_save');
Route::get('/invoice','InvoiceController@invoice_show');
Route::get('/invoice/edit/{id}','InvoiceController@invoice_edit');
Route::get('/invoice/delete/{id}','InvoiceController@invoice_delete');
Route::post('/invoice/update','InvoiceController@invoice_update');
Route::post('/invoice/datatable','InvoiceController@invoice_datatable');
Route::get('/invoice/get/{id}','InvoiceController@invoice_get');
Route::get('/invoice/detail','InvoiceController@invoice_detail');


//Terima Barang Baru
Route::get('/baru', 'TerimabarangbaruController@baru_show');
Route::get('/baru/print/{id}', 'TerimabarangbaruController@baru_print');
Route::post('/baru/datatable', 'TerimabarangbaruController@baru_datatable');
Route::get('/tbb/show', 'TerimabarangbaruController@tbb_show');
Route::post('/tbb/datatable', 'TerimabarangbaruController@tbb_datatable');

//Terima Barang Lama
Route::get('/lama', 'TerimabaranglamaController@lama_show');
Route::post('/lama/datatable', 'TerimabaranglamaController@lama_datatable');
Route::get('/tbl/show', 'TerimabaranglamaController@tbl_show');

Route::post('/tbl/datatable', 'TerimabaranglamaController@tbl_datatable');

//Keluar Barang

//Role
Route::get('/grole/add', 'GroleController@index');
Route::post('/grole/save', 'GroleController@grole_save');
Route::get('/grole', 'GroleController@grole_show');
Route::get('/grole/edit/{id}', 'GroleController@grole_edit');
Route::get('/grole/delete/{id}', 'GroleController@grole_delete');
Route::post('/grole/update', 'GroleController@grole_update');
Route::post('/grole/datatable', 'GroleController@grole_datatable');
Route::get('/grole/get/{id}', 'GroleController@grole_get');


//User

Route::get('/user/add', 'FmUserController@index');
Route::post('/user/save', 'FmUserController@user_save');
Route::get('/user', 'FmUserController@user_show');
Route::post('/user/datatable', 'FmUserController@user_datatable');


//Login



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
