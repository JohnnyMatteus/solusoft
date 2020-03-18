<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Aqui são as rotas de clientes - CRUD
Route::resource('clientes', 'ClienteController');
//Aqui são as rotas de produtos - CRUD
Route::resource('produtos', 'ProdutoController');
//Aqui são as rotas de pedidos - CRUD
Route::resource('pedidos', 'PedidosController');
Route::get('pedidos/{id}/report', 'PedidosController@report');
Route::get('pedidos/{id}/sedmail', 'PedidosController@sedmail');
