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

Route::get('/admin/{id}/data/baru', 'adminController@new');
Route::post('/admin/{id}/data/baru', 'adminController@store');

Route::get('/admin/{id}/data/{id2}', 'adminController@detailUser');

Route::get('/admin/{id}/data/edit/{id2}', 'adminController@editUser');
Route::put('/admin/{id}/data/update/{id2}', 'adminController@updateUser');

Route::get('/admin/{id}/data/edit/password/{id2}', 'adminController@editPass');
Route::put('/admin/{id}/data/update/password/{id2}', 'adminController@updatePass');

Route::get('/admin/{id}/data/arahkan/{id2}', 'adminController@arahkanUser');

Route::get('/admin/{id}/data/{id2}/delete', 'adminController@delUser');

Route::get('/admin/{id}/pengumuman', 'adminController@pengumuman');
Route::get('/admin/{id}/pengumuman/{id2}', 'adminController@lihatAnn');

Route::post('/admin/{id}/pengumuman', 'pengumumanController@cariAnnPublish');

Route::get('/admin/{id}/laporan', 'adminController@laporan');
Route::get('/admin/{id}/laporan/baru', 'adminController@laporanBaru');
Route::post('/admin/{id}/laporan/baru', 'adminController@createLaporan');
Route::get('/admin/{id}/laporan/{id2}', 'adminController@lihatLaporan');
Route::get('/admin/{id}/laporan/{id2}/ubah', 'adminController@editLaporan');
Route::put('/admin/{id}/laporan/{id2}/update', 'adminController@updateLaporan');
Route::delete('/admin/{id}/laporan/{id2}/delete', 'adminController@deleteLaporan');
Route::put('/admin/{id}/laporan/{id2}/status', 'adminController@statusLaporan');

Route::get('/admin/{id}/statistika', 'Controller@statistika');



Route::get('/perdes/{id}', 'perdesController@index');
Route::get('/perdes/{id}/profil', 'perdesController@profil');

Route::get('/perdes/{id}/pengumuman/baru', 'perdesController@baruAnn');
Route::post('/perdes/{id}/pengumuman/baru', 'perdesController@createAnn');

Route::get('/perdes/{id}/pengumuman', 'perdesController@pengumuman');
Route::get('/perdes/{id}/pengumuman/{id2}', 'perdesController@lihatAnn');

Route::get('/perdes/{id}/pengumuman/{id2}/ubah', 'perdesController@editAnn');
Route::put('/perdes/{id}/pengumuman/{id2}/update', 'perdesController@updateAnn');

Route::put('/perdes/{id}/pengumuman/{id2}/status', 'perdesController@statusAnn');

// Route::post('/perdes/{id}/pengumuman', 'pengumumanController@filterStat');
Route::post('/perdes/{id}/pengumuman', 'pengumumanController@cariAnn');

Route::get('/perdes/{id}/laporan', 'perdesController@laporan');
Route::get('/perdes/{id}/laporan/baru', 'perdesController@laporanBaru');
Route::post('/perdes/{id}/laporan/baru', 'perdesController@createLaporan');
Route::get('/perdes/{id}/laporan/{id2}/ubah', 'perdesController@editLaporan');
Route::put('/perdes/{id}/laporan/{id2}/update', 'perdesController@updateLaporan');
Route::get('/perdes/{id}/laporan/{id2}', 'perdesController@lihatLaporan');
Route::delete('/perdes/{id}/laporan/{id2}/delete', 'perdesController@deleteLaporan');
Route::put('/perdes/{id}/laporan/{id2}/status', 'perdesController@statusLaporan');

Route::get('/perdes/{id}/statistika', 'Controller@statistika');



Route::get('/warga/{id}', 'wargaController@index');
Route::get('/warga/{id}/profil', 'wargaController@profil');
Route::get('/warga/{id}/pengumuman', 'wargaController@pengumuman');
Route::get('/warga/{id}/pengumuman/{id2}', 'wargaController@lihatAnn');

Route::post('/warga/{id}/pengumuman', 'pengumumanController@cariAnnPublish');

Route::get('/warga/{id}/laporan', 'wargaController@laporan');
Route::get('/warga/{id}/laporan/baru', 'wargaController@laporanBaru');
Route::post('/warga/{id}/laporan/baru', 'wargaController@createLaporan');
Route::get('/warga/{id}/laporan/{id2}', 'wargaController@lihatLaporan');
Route::get('/warga/{id}/laporan/{id2}/ubah', 'wargaController@editLaporan');
Route::put('/warga/{id}/laporan/{id2}/update', 'wargaController@updateLaporan');
Route::delete('/warga/{id}/laporan/{id2}/delete', 'wargaController@deleteLaporan');
Route::put('/warga/{id}/laporan/{id2}/status', 'wargaController@statusLaporan');

Route::get('/warga/{id}/statistika', 'Controller@statistika');


Route::get('/kades/{id}', 'kadesController@index');
Route::get('/kades/{id}/profil', 'kadesController@profil');

Route::get('/kades/{id}/pengumuman/baru', 'kadesController@baruAnn');
Route::post('/kades/{id}/pengumuman/baru', 'kadesController@createAnn');

Route::get('/kades/{id}/pengumuman', 'kadesController@pengumuman');
Route::get('/kades/{id}/pengumuman/{id2}', 'kadesController@lihatAnn');

Route::post('/kades/{id}/pengumuman', 'pengumumanController@cariAnn');

Route::get('/kades/{id}/pengumuman/{id2}/ubah', 'kadesController@editAnn');
Route::put('/kades/{id}/pengumuman/{id2}/update', 'kadesController@updateAnn');

Route::put('/kades/{id}/pengumuman/{id2}/status', 'kadesController@statusAnn');

Route::get('/kades/{id}/laporan', 'kadesController@laporan');
Route::get('/kades/{id}/laporan/baru', 'kadesController@laporanBaru');
Route::post('/kades/{id}/laporan/baru', 'kadesController@createLaporan');
Route::get('/kades/{id}/laporan/{id2}', 'kadesController@lihatLaporan');
Route::get('/kades/{id}/laporan/{id2}/ubah', 'kadesController@editLaporan');
Route::put('/kades/{id}/laporan/{id2}/update', 'kadesController@updateLaporan');
Route::delete('/kades/{id}/laporan/{id2}/delete', 'kadesController@deleteLaporan');
Route::put('/kades/{id}/laporan/{id2}/status', 'kadesController@statusLaporan');

Route::get('/kades/{id}/statistika', 'Controller@statistika');


Route::post('/statistika/data', 'Controller@getData');

Route::post('/mapData', 'Controller@ajaxMap');


// Route::get('/admin/{id}/data/tablePerdes', 'adminController@tablePerdes');