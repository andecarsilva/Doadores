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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/recuperarsenha', function () {
    return view('auth.passwords.email');
});


// rotas cliente

Route::post('/newcliente','ClientesController@store');
Route::get('/deletecliente','ClientesController@destroy');
Route::get('/getclientes','ClientesController@show');
Route::post('/editliente','ClientesController@update');
Route::get('/gerarelatorio',function(){
    return view('relatorios.clientes');
});

Route::post('/newformapagamento','FormaPagamentoController@store');




