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

Route::get('/', function () {
    return view('masuk');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/daftar', 'Auth\RegisterController@daftar');
Route::POST('/daftar', 'Auth\RegisterController@create');
// Route::POST('/daftar/select', 'Auth\RegisterController@ajax');

Route::get('/dash', 'HomeController@dash');

Route::get('/admin/{id}/data/baru', 'adminController@new');
Route::post('/admin/{id}/data/baru', 'adminController@store');

Route::get('/admin/{id}/data/edit/{id2}', 'adminController@editUser');
Route::put('/admin/{id}/data/update/{id2}', 'adminController@updateUser');

Route::get('/admin/{id}/data/edit/password/{id2}', 'adminController@editPass');
Route::put('/admin/{id}/data/update/password/{id2}', 'adminController@updatePass');

Route::get('/admin/{id}/data/arahkan/{id2}', 'adminController@arahkanUser');

Route::get('/admin/{id}', 'adminController@index');
Route::get('/admin/{id}/data', 'adminController@dataUser');

Route::get('/admin/{id}/data/perdes', 'adminController@perdes');
Route::get('/admin/{id}/data/perdes/{id2}', 'adminController@detailUser');
Route::delete('/admin/{id}/data/perdes/{id2}', 'adminController@perdesDel');

Route::get('/admin/{id}/data/warga', 'adminController@warga');
Route::get('/admin/{id}/data/warga/{id2}', 'adminController@detailUser');
Route::delete('/admin/{id}/data/warga/{id2}', 'adminController@wargasDel');

Route::get('/admin/{id}/data/admin', 'adminController@admin');
Route::get('/admin/{id}/data/admin/{id2}', 'adminController@detailUser');
Route::delete('/admin/{id}/data/admin/{id2}', 'adminController@adminDel');


Route::get('/perdes/{id}', 'perdesController@index');
Route::get('/perdes/{id}/profil', 'perdesController@profil');

Route::get('/warga/{id}', 'wargaController@index');
Route::get('/warga/{id}/profil', 'wargaController@profil');

Route::get('/kades/{id}', 'kadesController@index');
Route::get('/kades/{id}/profil', 'kadesController@profil');


// Route::get('/admin/{id}/data/tablePerdes', 'adminController@tablePerdes');