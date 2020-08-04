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

Route::get('removesparepartfile', 'SparePartController@removesparepartfile')->name('removesparepartfile');
Route::get('removepositionfile', 'PositionController@removepositionfile')->name('removepositionfile');

Route::post('uploadpositionfile', 'PositionController@uploadpositionfile')->name('uploadpositionfile');
Route::get('neworder/{position_id}/{spare_part_id}/{amount}', 'SparePartOrderController@neworder')->name('neworder');
Route::get('confirmorder/{sparepartorder_id}', 'SparePartOrderController@confirmorder')->name('confirmorder');

Route::resource('positions', 'PositionController');
Route::resource('spareparts', 'SparePartController');
Route::resource('revisions', 'RevisionController');
Route::resource('sparepartorders', 'SparePartOrderController');
