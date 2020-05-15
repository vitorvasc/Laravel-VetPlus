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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', ['as' => 'site.logout', 'uses' => 'Login\LoginController@logout']);

    Route::get('/inicio', ['as' => 'site.home', 'uses' => 'Home\HomeController@index']);

    Route::get('/especies', ['as' => 'site.especies', 'uses' => 'Especies\EspeciesController@index']);
    Route::get('/especies/criar', ['as' => 'site.especies.create', 'uses' => 'Especies\EspeciesController@create']);
    Route::post('/especies/criar', ['as' => 'site.especies.insert', 'uses' => 'Especies\EspeciesController@insert']);
    Route::get('/especies/editar/{id}', ['as' => 'site.especies.edit', 'uses' => 'Especies\EspeciesController@edit']);
    Route::post('/especies/editar/{id}', ['as' => 'site.especies.edit.validate', 'uses' => 'Especies\EspeciesController@editValidate']);

    Route::get('/racas', ['as' => 'site.racas', 'uses' => 'Racas\RacasController@index']);
    Route::get('/racas/criar', ['as' => 'site.racas.create', 'uses' => 'Racas\RacasController@create']);
    Route::post('/racas/criar', ['as' => 'site.racas.insert', 'uses' => 'Racas\RacasController@insert']);
    Route::get('/racas/editar/{id}', ['as' => 'site.racas.edit', 'uses' => 'Racas\RacasController@edit']);
    Route::post('/racas/editar/{id}', ['as' => 'site.racas.edit.validate', 'uses' => 'Racas\RacasController@editValidate']);
    Route::get('/racas/listar-por-especie/{especie_id}', ['as' => 'site.racas.list', 'uses' => 'Racas\RacasController@listarPorEspecie']);

    Route::get('/usuarios', ['as' => 'site.usuarios', 'uses' => 'Usuarios\UsuariosController@index']);
    Route::get('/usuarios/criar', ['as' => 'site.usuarios.create', 'uses' => 'Usuarios\UsuariosController@create']);
    Route::post('/usuarios/criar', ['as' => 'site.usuarios.insert', 'uses' => 'Usuarios\UsuariosController@insert']);
    Route::get('/usuarios/editar/{id}', ['as' => 'site.usuarios.edit', 'uses' => 'Usuarios\UsuariosController@edit']);
    Route::post('/usuarios/editar/{id}', ['as' => 'site.usuarios.edit.validate', 'uses' => 'Usuarios\UsuariosController@editValidate']);
    Route::get('/usuarios/ativar/{id}', ['as' => 'site.usuarios.edit.status', 'uses' => 'Usuarios\UsuariosController@changeStatus']);
    Route::post('/usuarios/editar/{id}/permissao', ['as' => 'site.usuarios.edit.permission', 'uses' => 'Usuarios\UsuariosController@changePermission']);

    Route::get('/clientes', ['as' => 'site.clientes', 'uses' => 'Clientes\ClientesController@index']);
    Route::get('/clientes/criar', ['as' => 'site.clientes.create', 'uses' => 'Clientes\ClientesController@create']);
    Route::post('/clientes/criar', ['as' => 'site.clientes.insert', 'uses' => 'Clientes\ClientesController@insert']);
    Route::get('/clientes/{id}', ['as' => 'site.clientes.view', 'uses' => 'Clientes\ClientesController@view']);
    Route::get('/clientes/editar/{id}', ['as' => 'site.clientes.edit', 'uses' => 'Clientes\ClientesController@edit']);
    Route::post('/clientes/editar/{id}', ['as' => 'site.clientes.edit.validate', 'uses' => 'Clientes\ClientesController@editValidate']);

    Route::get('/pacientes', ['as' => 'site.pacientes', 'uses' => 'Pacientes\PacientesController@index']);
    Route::get('/pacientes/criar', ['as' => 'site.pacientes.create', 'uses' => 'Pacientes\PacientesController@create']);
    Route::post('/pacientes/criar', ['as' => 'site.pacientes.insert', 'uses' => 'Pacientes\PacientesController@insert']);
    Route::get('/pacientes/{id}', ['as' => 'site.pacientes.view', 'uses' => 'Pacientes\PacientesController@view']);
    Route::get('/pacientes/editar/{id}', ['as' => 'site.pacientes.edit', 'uses' => 'Pacientes\PacientesController@edit']);
    Route::post('/pacientes/editar/{id}', ['as' => 'site.pacientes.edit.validate', 'uses' => 'Pacientes\PacientesController@editValidate']);

    Route::get('/consultas', ['as' => 'site.consultas', 'uses' => 'Consultas\ConsultasController@index']);
    Route::get('/pacientes/criar', ['as' => 'site.consultas.create', 'uses' => 'Consultas\ConsultasController@create']);
    Route::post('/consultas/criar', ['as' => 'site.consultas.insert', 'uses' => 'Consultas\ConsultasController@insert']);
    Route::get('/consultas/{id}', ['as' => 'site.consultas.view', 'uses' => 'Consultas\ConsultasController@view']);
    Route::get('/consultas/editar/{id}', ['as' => 'site.consultas.edit', 'uses' => 'Consultas\ConsultasController@edit']);
    Route::post('/consultas/editar/{id}', ['as' => 'site.consultas.edit.validate', 'uses' => 'Consultas\ConsultasController@editValidate']);

    //FIXME: rotas de post nao podem retornar view

});
