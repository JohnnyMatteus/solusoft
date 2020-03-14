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

//Rotas clientes - CRUD
Route::resource('clientes', 'ClienteController');
//Rotas produtos - CRUD
Route::resource('produtos', 'ProdutoController');
//Rotas pedidos - CRUD
