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

Route::get('/','HomeController@showHome')->name('home');
Route::get('/login','HomeController@showLogin')->name('showLogin');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::get('/dashboard','Publico\HomeController@showDashboard')->name('dashboard');


/*Seccion : Rutas de administracion
 * Descripcion:
 * Author : Azael Ponce
 */
Route::resource('roles','Protegido\RolController');
Route::get('roles/get/list','Protegido\RolController@getList')->name('roles.get.list');
