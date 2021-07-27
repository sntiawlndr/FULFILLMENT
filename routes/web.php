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
Route::get('/home','HomeController@index');
Route::get('/product/add','ProductController@index');
Route::post('/product/save','ProductController@product_save');
Route::get('/product','ProductController@product_show');
Route::get('/product/edit/{id}','ProductController@product_edit');
Route::get('/product/delete/{id}','ProductController@product_delete');
Route::post('/product/update','ProductController@product_update');
Route::post('/product/datatable','ProductController@product_datatable');
Route::get('/product/get/{id}','ProductController@product_get');
//Barang
Route::get('/barang/upload','BarangController@upload_show');
Route::get('/barang/add','BarangController@index');
Route::post('/barang/save','BarangController@barang_save');
Route::get('/barang','BarangController@barang_show');
Route::get('/barang/edit/{id}','BarangController@barang_edit');
Route::get('/barang/delete/{id}','BarangController@barang_delete');
Route::post('/barang/update','BarangController@barang_update');
Route::post('/barang/datatable','BarangController@barang_datatable');
Route::get('/barang/get/{id}','BarangController@barang_get');
Route::get('/upload', 'UploadController@upload');
Route::post('/upload/proses', 'UploadController@proses_upload');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');