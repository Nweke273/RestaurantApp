<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/management', function () {
    return view('management.index');
});


//Category Controller Route
Route::resource('/management/category', 'App\Http\Controllers\Management\CategoryController');

//Menu Controller Route
Route::resource('/management/menu', 'App\Http\Controllers\Management\MenuController');

//Table Controller
Route::resource('/management/table', 'App\Http\Controllers\Management\TableController');

Route::resource('/management/table', 'App\Http\Controllers\Management\TableController');

Route::post('/cashier/orderFood', 'App\Http\Controllers\Cashier\CashierController@orderFood');

Route::get('/cashier/getTable', 'App\Http\Controllers\Cashier\CashierController@getTables');
Route::get('/cashier/getMenuByCategory/{category_id}', 'App\Http\Controllers\Cashier\CashierController@getMenuByCategory');
Route::get('/cashier', 'App\Http\Controllers\Cashier\CashierController@index');
