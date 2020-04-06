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

Route::get('/', ['uses' => 'Login\LoginController@index']);

Route::get('/login', ['as' => 'site.login', 'uses' => 'Login\LoginController@index']);
Route::post('/login/validate', ['as' => 'site.login.validate', 'uses' => 'Login\LoginController@login']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', ['as' => 'site.logout', 'uses' => 'Login\LoginController@logout']);
    
    Route::get('/inicio', ['as' => 'site.logout', 'uses' => 'Home\HomeController@index']);
});