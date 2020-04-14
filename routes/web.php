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
    
    Route::get('/inicio', ['as' => 'site.home', 'uses' => 'Home\HomeController@index']);

    Route::get('/especies', ['as' => 'site.especies', 'uses' => 'Especies\EspeciesController@index']);
    Route::get('/especies/criar', ['as' => 'site.especies.create', 'uses' => 'Especies\EspeciesController@create']);
    Route::post('/especies/criar', ['as' => 'site.especies.insert', 'uses' => 'Especies\EspeciesController@insert']);
    Route::get('/especies/editar/{id}', ['as' => 'site.especies.edit', 'uses' => 'Especies\EspeciesController@edit']);
    Route::post('/especies/editar/{id}', ['as' => 'site.especies.edit.validate', 'uses' => 'Especies\EspeciesController@editValidate']);

    // Route::get('/racas', ['as' => 'site.racas', 'uses' => ])
});