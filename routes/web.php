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

//Routes authenticate
Auth::routes();

//Routes app
Route::get('/', function () {return view('auth.login');});

//PANTALLA PRINCIPAL
Route::get('/home', 'HomeController@index')->middleware('auth');

//PANTALLA USUARIOS
Route::get('/usuarios', 'UsuarioController@index')->middleware('auth');
Route::get('/usuarios-manage', 'UsuarioController@manageUsers')->middleware('auth');
Route::get('/usuarios-manage/{id}', 'UsuarioController@editUsers')->middleware('auth');

//PANTALLA VEHICULOS
Route::get('/vehiculos', 'ConductorController@index')->middleware('auth');

//PANTALLA LOGISTICA
Route::get('/logistica', 'LogisticaController@index')->middleware('auth');

//PANTALLA CLIENTES
Route::get('/clientes', 'ClienteController@index')->middleware('auth');

//PANTALLA FACTURACION
Route::get('/facturacion', 'FacturaController@index')->middleware('auth');

//PANTALLA CONFIGURACION
Route::get('/configuracion', 'HomeController@index')->middleware('auth');

//Routes API

Route::post('/api/usuario', 'UsuarioController@create')->middleware('auth');
Route::get('/api/usuarios', 'UsuarioController@list')->middleware('auth');
Route::delete('/api/usuario', 'UsuarioController@delete')->middleware('auth');

