<?php

use App\Http\Controllers\SearchController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('search', 'SearchController@search')->name('search');
Route::get('advancedsearch', 'SearchController@advancedsearch')->name('advancedsearch');
Route::get('advancedsearchresults', 'SearchController@advancedsearchresults')->name('advancedsearchresults');

Route::resource('positions', 'PositionController');
Route::resource('spareparts', 'SparePartController');
