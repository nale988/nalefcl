<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
    // return view('welcome');
// });

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('search', 'SearchController@search')->name('search');
Route::get('advancedsearch', 'SearchController@advancedsearch')->name('advancedsearch');
Route::get('advancedsearchresults', 'SearchController@advancedsearchresults')->name('advancedsearchresults');
Route::get('dangerlevelspareparts', 'SparePartController@dangerlevelspareparts')->name('dangerlevelspareparts');

Route::get('favorite/{id}', 'PositionController@favorite')->name('favorite');

Route::get('removesparepartfile', 'SparePartController@removesparepartfile')->name('removesparepartfile');
Route::get('removepositionfile/{id}', 'PositionController@removepositionfile')->name('removepositionfile');
Route::get('removecompressorservicefile/{id}', 'PositionController@removecompressorservicefile')->name('removecompressorservicefile');
Route::get('removeblowerservicefile/{id}', 'PositionController@removeblowerservicefile')->name('removeblowerservicefile');
Route::get('removerevisionfile/{id}', 'RevisionController@removerevisionfile')->name('removerevisionfile');
Route::get('editworkinghours/{id}', 'PositionController@editworkinghours')->name('editworkinghours');
Route::get('editblowerservice/{id}', 'PositionController@editblowerservice')->name('editblowerservice');


Route::post('uploadpositionfile', 'PositionController@uploadpositionfile')->name('uploadpositionfile');
Route::post('storeworkinghours', 'PositionController@storeworkinghours')->name('storeworkinghours');
Route::post('updateworkinghours', 'PositionController@updateworkinghours')->name('updateworkinghours');
Route::post('storecompressorservice', 'PositionController@storecompressorservice')->name('storecompressorservice');
Route::post('storeblowerservice', 'PositionController@storeblowerservice')->name('storeblowerservice');
Route::post('updateblowerservice', 'PositionController@updateblowerservice')->name('updateblowerservice');

Route::get('workorder/{id}', 'PositionController@workorder')->name('workorder');
Route::get('workorders/{position}', 'PositionController@workorders') -> name('workorders');
Route::get('neworder/{position_id?}/{spare_part_id?}/{amount?}', 'SparePartOrderController@neworder')->name('neworder');
Route::get('confirmorder/{sparepartorder_id}', 'SparePartOrderController@confirmorder')->name('confirmorder');

Route::get('todos/finish/{id}', 'ToDoController@finish')->name('todos.finish');
Route::get('todo/postpone/{id}', 'ToDoController@postpone')->name('todos.postpone');

Route::get('worktimes/review', 'WorkTimeController@review')->name('worktimes.review');
Route::get('worktimes/delete/{id}', 'WorkTimeController@delete')->name('worktimes.delete');

Route::resource('positions', 'PositionController');
Route::resource('spareparts', 'SparePartController');
Route::resource('revisions', 'RevisionController');
Route::resource('sparepartorders', 'SparePartOrderController');
Route::resource('worktimes', 'WorkTimeController');
Route::resource('todos', 'ToDoController');
