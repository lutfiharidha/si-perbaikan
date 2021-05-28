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

Route::match(['get', 'post'], '/', function(){
    return redirect('/login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/ruangan', 'APIController@loadData')->name('searchRuang');

//ADMIN SECTION
Route::get('/admin', 'AdminController@index')->name('admin.Dashboard')->middleware('admin');
Route::get('/admin/input-user', 'AdminController@inputUser')->name('inputUser')->middleware('admin');
Route::post('/admin/input-user', 'AdminController@storeUser')->name('storeUser')->middleware('admin');
Route::get('/admin/laporan-user', 'AdminController@laporanUser')->name('laporanUser')->middleware('admin');
Route::get('/admin/edit-user/{id}', 'AdminController@editUser')->name('admin.editUser')->middleware('admin');
Route::put('/admin/edit-user/{id}', 'AdminController@updateUser')->name('admin.updateUser')->middleware('admin');
Route::delete('/admin/delete-user/{user}', 'AdminController@deleteUser')->name('admin.deleteUser')->middleware('admin');

Route::get('/admin/input-ruang', 'AdminController@inputRuang')->name('admin.inputRuang')->middleware('admin');
Route::post('/admin/input-ruang', 'AdminController@storeRuang')->name('admin.storeRuang')->middleware('admin');
Route::get('/admin/edit-ruang/{id}', 'AdminController@editRuang')->name('admin.editRuang')->middleware('admin');
Route::post('/admin/edit-ruang/{id}', 'AdminController@updateRuang')->name('admin.updateRuang')->middleware('admin');
Route::get('/admin/laporan-ruang', 'AdminController@laporanRuang')->name('admin.laporanRuang')->middleware('admin');
Route::delete('/admin/delete-ruang/{ruang}', 'AdminController@deleteRuang')->name('admin.deleteRuang')->middleware('admin');

Route::get('/admin/input-fasilitas', 'AdminController@inputFasilitas')->name('admin.inputFasilitas')->middleware('admin');
Route::post('/admin/input-fasilitas', 'AdminController@storeFasilitas')->name('admin.storeFasilitas')->middleware('admin');
Route::get('/admin/edit-fasilitas/{id}', 'AdminController@editFasilitas')->name('admin.editFasilitas')->middleware('admin');
Route::post('/admin/edit-fasilitas/{id}', 'AdminController@updateFasilitas')->name('admin.updateFasilitas')->middleware('admin');
Route::get('/admin/laporan-fasilitas', 'AdminController@laporanFasilitas')->name('admin.laporanFasilitas')->middleware('admin');
Route::delete('/admin/delete-fasilitas/{fasilitas}', 'AdminController@deleteFasilitas')->name('admin.deleteFasilitas')->middleware('admin');

Route::get('/admin/edit-kerusakan/{id}', 'AdminController@editKerusakan')->name('admin.editKerusakan')->middleware('admin');
Route::put('/admin/edit-kerusakan/{id}', 'AdminController@updateKerusakan')->name('admin.updateKerusakan')->middleware('admin');
Route::delete('/admin/delete-kerusakan/{kerusakan}', 'AdminController@deleteKerusakan')->name('admin.deleteKerusakan')->middleware('admin');
Route::get('/admin/laporan-kerusakan', 'AdminController@laporanKerusakan')->name('laporanKerusakan')->middleware('admin');
Route::get('/admin/laporan-perbaikan', 'AdminController@laporanPerbaikan')->name('laporanPerbaikan')->middleware('admin');


//SEKOLAH SECTION
Route::get('/sekolah', 'SekolahController@index')->name('sekolah.Dashboard')->middleware('sekolah');
Route::get('/sekolah/laporan-kerusakan', 'SekolahController@dataPerbaikan')->name('sekolah.dataPerbaikan')->middleware('sekolah');
Route::get('/sekolah/laporan-perbaikan', 'SekolahController@laporanPerbaikan')->name('sekolah.laporanPerbaikan')->middleware('sekolah');
Route::get('/sekolah/kerusakan', 'SekolahController@dataKerusakan')->name('dataKerusakan')->middleware('sekolah');
Route::get('/sekolah/input-kerusakan', 'SekolahController@inputKerusakan')->name('sekolah.inputKerusakan')->middleware('sekolah');
Route::post('/sekolah/input-kerusakan', 'SekolahController@storeKerusakan')->name('sekolah.storeKerusakan')->middleware('sekolah');
Route::get('/sekolah/edit-kerusakan/{id}', 'SekolahController@editKerusakan')->name('sekolah.editKerusakan')->middleware('sekolah');
Route::put('/sekolah/edit-kerusakan/{id}', 'SekolahController@updateKerusakan')->name('sekolah.updateKerusakan')->middleware('sekolah');
Route::delete('/sekolah/delete-kerusakan/{kerusakan}', 'SekolahController@deleteKerusakan')->name('sekolah.deleteKerusakan')->middleware('sekolah');

Route::get('/sekolah/input-ruang', 'SekolahController@inputRuang')->name('sekolah.inputRuang')->middleware('sekolah');
Route::post('/sekolah/input-ruang', 'SekolahController@storeRuang')->name('sekolah.storeRuang')->middleware('sekolah');
Route::get('/sekolah/laporan-ruang', 'SekolahController@laporanRuang')->name('sekolah.laporanRuang')->middleware('sekolah');
Route::get('/sekolah/edit-ruang/{id}', 'SekolahController@editRuang')->name('sekolah.editRuang')->middleware('sekolah');
Route::post('/sekolah/edit-ruang/{id}', 'SekolahController@updateRuang')->name('sekolah.updateRuang')->middleware('sekolah');
Route::delete('/sekolah/delete-ruang/{ruang}', 'SekolahController@deleteRuang')->name('sekolah.deleteRuang')->middleware('sekolah');

Route::get('/sekolah/laporan-fasilitas/{tingkat}/{asrama?}', 'SekolahController@dataFasilitas')->name('sekolah.dataFasilitas')->middleware('sekolah');
Route::get('/sekolah/input-fasilitas', 'SekolahController@inputFasilitas')->name('sekolah.inputFasilitas')->middleware('sekolah');
Route::post('/sekolah/input-fasilitas', 'SekolahController@storeFasilitas')->name('sekolah.storeFasilitas')->middleware('sekolah');
Route::get('/sekolah/edit-fasilitas/{id}', 'SekolahController@editFasilitas')->name('sekolah.editFasilitas')->middleware('sekolah');
Route::post('/sekolah/edit-fasilitas/{id}', 'SekolahController@updateFasilitas')->name('sekolah.updateFasilitas')->middleware('sekolah');
Route::delete('/sekolah/delete-fasilitas/{fasilitas}', 'SekolahController@deleteFasilitas')->name('sekolah.deleteFasilitas')->middleware('sekolah');

//ASRAMA SECTION
Route::get('/asrama', 'AsramaController@index')->name('asrama.Dashboard')->middleware('asrama');
Route::get('/asrama/laporan-perbaikan', 'AsramaController@dataPerbaikan')->name('asrama.dataPerbaikan')->middleware('asrama');
Route::get('/asrama/input-kerusakan', 'AsramaController@inputKerusakan')->name('asrama.inputKerusakan')->middleware('asrama');
Route::post('/asrama/input-kerusakan', 'AsramaController@storeKerusakan')->name('asrama.storeKerusakan')->middleware('asrama');
