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
    return view('welcome');
});

Auth::routes();

//Route::get('category-tree-view','CategoryController@manageCategory')->name('category-tree-view');
Route::post('add-category','CategoryController@addCategory')->name('add.category');
Route::patch('edit-category','CategoryController@editCategory')->name('edit.category');
Route::delete('delete-category','CategoryController@deleteCategory')->name('delete.category');
Route::post('add-file','FileController@addFile')->name('add.file');
Route::get('get-file/{id}','FileController@getFiles')->name('get.files');
Route::get('get-operations/{id}','CategoryController@getOperations')->name('get.operations');
Route::get('get-permission/{id}','PermissionController@getPermissions')->name('get.permissions');
Route::get('set-upload-permission/{id}','PermissionController@setUploadPermission')->name('set.upload.permissions');
Route::get('set-download-permission/{id}','PermissionController@setDownloadPermission')->name('set.download.permissions');
Route::get('download/{id}','FileController@downloadFile')->name('download.file');


Route::resource('category','CategoryController');
