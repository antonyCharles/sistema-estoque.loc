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

/*
|   Include Rotas de Logins.
*/
include 'groups/logins.php';

/*
|   Include Rotas de Settings.
*/
include 'groups/settings.php';

Route::group(['middleware'=>['auth']], function(){

    Route::get('/', function () {return view('welcome');});

    Route::get('/funcionario', 'FuncionarioController@list')->middleware('role:'.trans('roles.userRead'));
    Route::get('/funcionario/{id}/detalhe', 'FuncionarioController@detalhe')->middleware('role:'.trans('roles.userRead'));
    Route::get('/funcionario/create', 'FuncionarioController@create')->middleware('role:'.trans('roles.userCreate'));
    Route::post('/funcionario/create', 'FuncionarioController@createPost')->middleware('role:'.trans('roles.userCreate'));
    Route::get('/funcionario/{id}/update', 'FuncionarioController@update')->middleware('role:'.trans('roles.userUpdate'));
    Route::post('/funcionario/{id}/update', 'FuncionarioController@updatePost')->middleware('role:'.trans('roles.userUpdate'));
    Route::get('/funcionario/{id}/delete', 'FuncionarioController@delete')->middleware('role:'.trans('roles.userDelete'));
    Route::post('/funcionario/{id}/delete', 'FuncionarioController@deletePost')->middleware('role:'.trans('roles.userDelete'));

    Route::get('/fornecedor', 'FornecedorController@list')->middleware('role:'.trans('roles.fornecedorRead'));
    Route::get('/fornecedor/{id}/detalhe', 'FornecedorController@detalhe')->middleware('role:'.trans('roles.fornecedorRead'));
    Route::get('/fornecedor/create', 'FornecedorController@create')->middleware('role:'.trans('roles.fornecedorCreate'));
    Route::post('/fornecedor/create', 'FornecedorController@createPost')->middleware('role:'.trans('roles.fornecedorCreate'));
    Route::get('/fornecedor/{id}/update', 'FornecedorController@update')->middleware('role:'.trans('roles.fornecedorUpdate'));
    Route::post('/fornecedor/{id}/update', 'FornecedorController@updatePost')->middleware('role:'.trans('roles.fornecedorUpdate'));
    Route::get('/fornecedor/{id}/delete', 'FornecedorController@delete')->middleware('role:'.trans('roles.fornecedorDelete'));
    Route::post('/fornecedor/{id}/delete', 'FornecedorController@deletePost')->middleware('role:'.trans('roles.fornecedorDelete'));

    Route::get('/tipo-produto', 'TipoProdutoController@list')->middleware('role:'.trans('roles.tipoProdutoRead'));
    Route::get('/tipo-produto/create', 'TipoProdutoController@create')->middleware('role:'.trans('roles.tipoProdutoCreate'));
    Route::post('/tipo-produto/create', 'TipoProdutoController@createPost')->middleware('role:'.trans('roles.tipoProdutoCreate'));
    Route::get('/tipo-produto/{id}/update', 'TipoProdutoController@update')->middleware('role:'.trans('roles.tipoProdutoUpdate'));
    Route::post('/tipo-produto/{id}/update', 'TipoProdutoController@updatePost')->middleware('role:'.trans('roles.tipoProdutoUpdate'));
    Route::get('/tipo-produto/{id}/delete', 'TipoProdutoController@delete')->middleware('role:'.trans('roles.tipoProdutoDelete'));
    Route::post('/tipo-produto/{id}/delete', 'TipoProdutoController@deletePost')->middleware('role:'.trans('roles.tipoProdutoDelete'));

    Route::get('/tipo-pagto', 'TipoPagtoController@list')->middleware('role:'.trans('roles.tipoPagtoRead'));
    Route::get('/tipo-pagto/create', 'TipoPagtoController@create')->middleware('role:'.trans('roles.tipoPagtoCreate'));
    Route::post('/tipo-pagto/create', 'TipoPagtoController@createPost')->middleware('role:'.trans('roles.tipoPagtoCreate'));
    Route::get('/tipo-pagto/{id}/update', 'TipoPagtoController@update')->middleware('role:'.trans('roles.tipoPagtoUpdate'));
    Route::post('/tipo-pagto/{id}/update', 'TipoPagtoController@updatePost')->middleware('role:'.trans('roles.tipoPagtoUpdate'));
    Route::get('/tipo-pagto/{id}/delete', 'TipoPagtoController@delete')->middleware('role:'.trans('roles.tipoPagtoDelete'));
    Route::post('/tipo-pagto/{id}/delete', 'TipoPagtoController@deletePost')->middleware('role:'.trans('roles.tipoPagtoDelete'));

    Route::get('/produto', 'ProdutoController@list')->middleware('role:'.trans('roles.produtoRead'));
    Route::get('/produto/{id}/detalhe', 'ProdutoController@detalhe')->middleware('role:'.trans('roles.produtoRead'));
    Route::get('/produto/create', 'ProdutoController@create')->middleware('role:'.trans('roles.produtoCreate'));
    Route::post('/produto/create', 'ProdutoController@createPost')->middleware('role:'.trans('roles.produtoCreate'));
    Route::get('/produto/{id}/update', 'ProdutoController@update')->middleware('role:'.trans('roles.produtoUpdate'));
    Route::post('/produto/{id}/update', 'ProdutoController@updatePost')->middleware('role:'.trans('roles.produtoUpdate'));
    Route::get('/produto/{id}/delete', 'ProdutoController@delete')->middleware('role:'.trans('roles.produtoDelete'));
    Route::post('/produto/{id}/delete', 'ProdutoController@deletePost')->middleware('role:'.trans('roles.produtoDelete'));

    Route::get('/nota-fiscal', 'NotaFiscalController@list')->middleware('role:'.trans('roles.notaFiscalRead'));
    Route::get('/nota-fiscal/{id}/detalhe', 'NotaFiscalController@detalhe')->middleware('role:'.trans('roles.notaFiscalRead'));
    Route::get('/nota-fiscal/create', 'NotaFiscalController@create')->middleware('role:'.trans('roles.notaFiscalCreate'));
    Route::post('/nota-fiscal/create', 'NotaFiscalController@createPost')->middleware('role:'.trans('roles.notaFiscalCreate'));
    Route::get('/nota-fiscal/{id}/update', 'NotaFiscalController@update')->middleware('role:'.trans('roles.notaFiscalUpdate'));
    Route::post('/nota-fiscal/{id}/update', 'NotaFiscalController@updatePost')->middleware('role:'.trans('roles.notaFiscalUpdate'));
    Route::get('/nota-fiscal/{id}/delete', 'NotaFiscalController@delete')->middleware('role:'.trans('roles.notaFiscalDelete'));
    Route::post('/nota-fiscal/{id}/delete', 'NotaFiscalController@deletePost')->middleware('role:'.trans('roles.notaFiscalDelete'));

    Route::get('/conta-pagar/{nf_codigo}/create', 'ContaPagarController@create')->middleware('role:'.trans('roles.contaPagarCreate'));
    Route::post('/conta-pagar/{nf_codigo}/create', 'ContaPagarController@createPost')->middleware('role:'.trans('roles.contaPagarCreate'));
    Route::get('/conta-pagar/{id}/update/{nf_codigo}', 'ContaPagarController@update')->middleware('role:'.trans('roles.contaPagarUpdate'));
    Route::post('/conta-pagar/{id}/update/{nf_codigo}', 'ContaPagarController@updatePost')->middleware('role:'.trans('roles.contaPagarUpdate'));
    Route::get('/conta-pagar/{id}/delete/{nf_codigo}', 'ContaPagarController@delete')->middleware('role:'.trans('roles.contaPagarDelete'));
    Route::post('/conta-pagar/{id}/delete/{nf_codigo}', 'ContaPagarController@deletePost')->middleware('role:'.trans('roles.contaPagarDelete'));

    Route::get('/conta-receber/{nf_codigo}/create', 'ContaReceberController@create')->middleware('role:'.trans('roles.contaReceberCreate'));
    Route::post('/conta-receber/{nf_codigo}/create', 'ContaReceberController@createPost')->middleware('role:'.trans('roles.contaReceberCreate'));
    Route::get('/conta-receber/{id}/update/{nf_codigo}', 'ContaReceberController@update')->middleware('role:'.trans('roles.contaReceberUpdate'));
    Route::post('/conta-receber/{id}/update/{nf_codigo}', 'ContaReceberController@updatePost')->middleware('role:'.trans('roles.contaReceberUpdate'));
    Route::get('/conta-receber/{id}/delete/{nf_codigo}', 'ContaReceberController@delete')->middleware('role:'.trans('roles.contaReceberDelete'));
    Route::post('/conta-receber/{id}/delete/{nf_codigo}', 'ContaReceberController@deletePost')->middleware('role:'.trans('roles.contaReceberDelete'));

    Route::get('/compra', 'CompraController@list')->middleware('role:'.trans('roles.compraRead'));
    Route::get('/compra/{id}/detalhe', 'CompraController@detalhe')->middleware('role:'.trans('roles.compraRead'));
    Route::get('/compra/create', 'CompraController@create')->middleware('role:'.trans('roles.compraCreate'));
    Route::post('/compra/create', 'CompraController@createPost')->middleware('role:'.trans('roles.compraCreate'));
    Route::get('/compra/{id}/clonar', 'CompraController@clonar')->middleware('role:'.trans('roles.compraClonar'));
    Route::get('/compra/{id}/update', 'CompraController@update')->middleware('role:'.trans('roles.compraUpdate'));
    Route::post('/compra/{id}/update', 'CompraController@updatePost')->middleware('role:'.trans('roles.compraUpdate'));
    Route::get('/compra/{id}/delete', 'CompraController@delete')->middleware('role:'.trans('roles.compraDelete'));
    Route::post('/compra/{id}/delete', 'CompraController@deletePost')->middleware('role:'.trans('roles.compraDelete'));

    Route::get('/venda', 'VendaController@list')->middleware('role:'.trans('roles.vendaRead'));
    Route::get('/venda/{id}/detalhe', 'VendaController@detalhe')->middleware('role:'.trans('roles.vendaRead'));
    Route::get('/venda/create', 'VendaController@create')->middleware('role:'.trans('roles.vendaCreate'));
    Route::post('/venda/create', 'VendaController@createPost')->middleware('role:'.trans('roles.vendaCreate'));
    Route::get('/venda/{id}/update', 'VendaController@update')->middleware('role:'.trans('roles.vendaUpdate'));
    Route::post('/venda/{id}/update', 'VendaController@updatePost')->middleware('role:'.trans('roles.vendaUpdate'));
    Route::get('/venda/{id}/delete', 'VendaController@delete')->middleware('role:'.trans('roles.vendaDelete'));
    Route::post('/venda/{id}/delete', 'VendaController@deletePost')->middleware('role:'.trans('roles.vendaDelete'));

});