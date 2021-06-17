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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuarios', 'UsuarioController@index');

Route::get('/vehiculos', 'ConductorController@index');

Route::get('/logistica', 'LogisticaController@index');

Route::get('/clientes', 'ClienteController@index');

Route::get('/facturacion', 'FacturaController@index');

Route::get('/configuracion', 'HomeController@index');
