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

//Route::get('/', 'HomepageController@index')->name('homepage');

Route::get('/','DashboardController@index')->name('dashboard.index');

Route::resource('/beasiswa','BeasiswaController')->names('dashboard.beasiswa');
Route::resource('/perusahaan','PerusahaanController')->names('dashboard.perusahaan');
Route::resource('/persyaratan','PersyaratanController')->names('dashboard.persyaratan');
Route::resource('/fasilitas','FasilitasController')->parameter("fasilitas","fasilitas")->names('dashboard.fasilitas');

Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

//Auth::routes();
