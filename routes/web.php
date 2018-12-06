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

Route::pattern('id', '\d+');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return "Login page";
})->name('login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/doctors', 'DoctorController@list')->name('doctors');
Route::get('/doctor/{id}', 'DoctorController@card')->name('doctor');
Route::get('/services', 'ServiceController@index')->name('services');

Route::post('/order', 'OrderController@order')->name('order');
Route::delete('/order/{id}', 'OrderController@cancel')->name('order.cancel');

Route::get('/personal', 'PersonalController@index')->name('my_orders');
