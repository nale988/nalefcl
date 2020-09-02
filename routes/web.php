<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
    // return view('welcome');
// });

//Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('search', 'SearchController@search')->name('search');
Route::Get('searchposition/{searchquery}', 'SearchController@searchposition')->name('searchposition');
Route::get('dangerlevelspareparts', 'SparePartController@dangerlevelspareparts')->name('dangerlevelspareparts');

Route::get('favorite/{id}', 'PositionController@favorite')->name('favorite');

Route::get('removesparepartfile', 'SparePartController@removesparepartfile')->name('removesparepartfile');
Route::get('removepositionfile/{id}', 'PositionController@removepositionfile')->name('removepositionfile');
Route::get('removecompressorservicefile/{id}', 'PositionController@removecompressorservicefile')->name('removecompressorservicefile');
Route::get('removeblowerservicefile/{id}', 'PositionController@removeblowerservicefile')->name('removeblowerservicefile');
Route::get('removerevisionfile/{id}', 'RevisionController@removerevisionfile')->name('removerevisionfile');
Route::get('editworkinghours/{id}', 'PositionController@editworkinghours')->name('editworkinghours');
Route::get('editblowerservice/{id}', 'PositionController@editblowerservice')->name('editblowerservice');
Route::get('showunits/{id}', 'PositionController@showunits')->name('showunits');

Route::get('workorders/create/{position_id}', 'WorkOrderController@create')->name('workorders.create');

Route::post('uploadpositionfile', 'PositionController@uploadpositionfile')->name('uploadpositionfile');
Route::post('storeworkinghours', 'PositionController@storeworkinghours')->name('storeworkinghours');
Route::post('updateworkinghours', 'PositionController@updateworkinghours')->name('updateworkinghours');
Route::post('storecompressorservice', 'PositionController@storecompressorservice')->name('storecompressorservice');
Route::post('storeblowerservice', 'PositionController@storeblowerservice')->name('storeblowerservice');
Route::post('updateblowerservice', 'PositionController@updateblowerservice')->name('updateblowerservice');

Route::get('positions/workorder/{id}', 'PositionController@workorder')->name('workorder');
Route::get('positions/workorders/{position}', 'PositionController@workorders') -> name('workorders');
Route::get('neworder/{position_id?}/{spare_part_id?}/{amount?}', 'SparePartOrderController@neworder')->name('neworder');
Route::get('confirmorder/{sparepartorder_id}', 'SparePartOrderController@confirmorder')->name('confirmorder');

Route::get('todos/finish/{id}', 'ToDoController@finish')->name('todos.finish');
Route::get('todos/postpone/{id}', 'ToDoController@postpone')->name('todos.postpone');
Route::get('todos/reactivate/{id}/{days}','ToDoController@reactivate')->name('todos.reactivate');
Route::get('todos/changetype/{id}', 'ToDoController@changetype')->name('todos.changetype');

Route::get('worktimes/review', 'WorkTimeController@review')->name('worktimes.review');
Route::get('worktimes/delete/{id}', 'WorkTimeController@delete')->name('worktimes.delete');

Route::get('personal/myworkorders', 'PersonalController@myworkorders')->name('personal.myworkorders');
Route::get('admin/users', 'AdminController@users')->name('admin.users');
Route::get('admin/permissions/{id}', 'AdminController@permissions')->name('admin.permissions');

Route::resource('positions', 'PositionController');
Route::resource('spareparts', 'SparePartController');
Route::resource('revisions', 'RevisionController');
Route::resource('sparepartorders', 'SparePartOrderController');
Route::resource('worktimes', 'WorkTimeController');
Route::resource('todos', 'ToDoController');
Route::resource('admin', 'AdminController');
Route::resource('personal', 'PersonalController');
Route::resource('workorders', 'WorkOrderController');
