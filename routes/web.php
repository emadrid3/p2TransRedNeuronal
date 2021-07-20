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
Route::get('/vehiculos', 'VehiculoController@index')->middleware('auth');
Route::get('/vehiculos-manage', 'VehiculoController@manageVehicles')->middleware('auth');

//PANTALLA CONDUCTORES
Route::get('/conductores', 'ConductorController@index')->middleware('auth');
Route::get('/conductores-manage', 'ConductorController@manageDrivers')->middleware('auth');
Route::get('/conductores-manage/{id}', 'ConductorController@editDrivers')->middleware('auth');

//PANTALLA LOGISTICA
Route::get('/logistica', 'LogisticaController@index')->middleware('auth');
Route::get('/logistica-manage', 'LogisticaController@manageLogistic')->middleware('auth');

//PANTALLA CLIENTES
Route::get('/clientes', 'ClienteController@index')->middleware('auth');
Route::get('/clientes-manage', 'ClienteController@manageCustomers')->middleware('auth');

//Routes API

//USUARIOS

Route::post('/api/usuario', 'UsuarioController@create')->middleware('auth');
Route::patch('/api/usuario', 'UsuarioController@update')->middleware('auth');
Route::delete('/api/usuario', 'UsuarioController@delete')->middleware('auth');
Route::get('/api/usuarios', 'UsuarioController@list')->middleware('auth');

//CONDUCTORES

Route::get('/api/conductores', 'ConductorController@list')->middleware('auth');
Route::patch('/api/conductores', 'ConductorController@update')->middleware('auth');

