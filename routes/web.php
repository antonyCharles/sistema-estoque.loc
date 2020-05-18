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

Route::get('/', function () {return view('welcome');});


Route::get('/funcionario', 'FuncionarioController@list');
Route::get('/funcionario/{id}/detalhe', 'FuncionarioController@detalhe');
Route::get('/funcionario/create', 'FuncionarioController@create');
Route::post('/funcionario/create', 'FuncionarioController@createPost');
Route::get('/funcionario/{id}/update', 'FuncionarioController@update');
Route::post('/funcionario/{id}/update', 'FuncionarioController@updatePost');
Route::get('/funcionario/{id}/delete', 'FuncionarioController@delete');
Route::post('/funcionario/{id}/delete', 'FuncionarioController@deletePost');

Route::get('/fornecedor', 'FornecedorController@list');
Route::get('/fornecedor/{id}/detalhe', 'FornecedorController@detalhe');
Route::get('/fornecedor/create', 'FornecedorController@create');
Route::post('/fornecedor/create', 'FornecedorController@createPost');
Route::get('/fornecedor/{id}/update', 'FornecedorController@update');
Route::post('/fornecedor/{id}/update', 'FornecedorController@updatePost');
Route::get('/fornecedor/{id}/delete', 'FornecedorController@delete');
Route::post('/fornecedor/{id}/delete', 'FornecedorController@deletePost');

Route::get('/tipo-produto', 'TipoProdutoController@list');
Route::get('/tipo-produto/create', 'TipoProdutoController@create');
Route::post('/tipo-produto/create', 'TipoProdutoController@createPost');
Route::get('/tipo-produto/{id}/update', 'TipoProdutoController@update');
Route::post('/tipo-produto/{id}/update', 'TipoProdutoController@updatePost');
Route::get('/tipo-produto/{id}/delete', 'TipoProdutoController@delete');
Route::post('/tipo-produto/{id}/delete', 'TipoProdutoController@deletePost');

Route::get('/tipo-pagto', 'TipoPagtoController@list');
Route::get('/tipo-pagto/create', 'TipoPagtoController@create');
Route::post('/tipo-pagto/create', 'TipoPagtoController@createPost');
Route::get('/tipo-pagto/{id}/update', 'TipoPagtoController@update');
Route::post('/tipo-pagto/{id}/update', 'TipoPagtoController@updatePost');
Route::get('/tipo-pagto/{id}/delete', 'TipoPagtoController@delete');
Route::post('/tipo-pagto/{id}/delete', 'TipoPagtoController@deletePost');

Route::get('/produto', 'ProdutoController@list');
Route::get('/produto/{id}/detalhe', 'ProdutoController@detalhe');
Route::get('/produto/create', 'ProdutoController@create');
Route::post('/produto/create', 'ProdutoController@createPost');
Route::get('/produto/{id}/update', 'ProdutoController@update');
Route::post('/produto/{id}/update', 'ProdutoController@updatePost');
Route::get('/produto/{id}/delete', 'ProdutoController@delete');
Route::post('/produto/{id}/delete', 'ProdutoController@deletePost');

Route::get('/nota-fiscal', 'NotaFiscalController@list');
Route::get('/nota-fiscal/{id}/detalhe', 'NotaFiscalController@detalhe');
Route::get('/nota-fiscal/create', 'NotaFiscalController@create');
Route::post('/nota-fiscal/create', 'NotaFiscalController@createPost');
Route::get('/nota-fiscal/{id}/update', 'NotaFiscalController@update');
Route::post('/nota-fiscal/{id}/update', 'NotaFiscalController@updatePost');
Route::get('/nota-fiscal/{id}/delete', 'NotaFiscalController@delete');
Route::post('/nota-fiscal/{id}/delete', 'NotaFiscalController@deletePost');

Route::get('/conta-pagar/{nf_codigo}/create', 'ContaPagarController@create');
Route::post('/conta-pagar/{nf_codigo}/create', 'ContaPagarController@createPost');
Route::get('/conta-pagar/{id}/update/{nf_codigo}', 'ContaPagarController@update');
Route::post('/conta-pagar/{id}/update/{nf_codigo}', 'ContaPagarController@updatePost');
Route::get('/conta-pagar/{id}/delete/{nf_codigo}', 'ContaPagarController@delete');
Route::post('/conta-pagar/{id}/delete/{nf_codigo}', 'ContaPagarController@deletePost');

Route::get('/conta-receber/{nf_codigo}/create', 'ContaReceberController@create');
Route::post('/conta-receber/{nf_codigo}/create', 'ContaReceberController@createPost');
Route::get('/conta-receber/{id}/update/{nf_codigo}', 'ContaReceberController@update');
Route::post('/conta-receber/{id}/update/{nf_codigo}', 'ContaReceberController@updatePost');
Route::get('/conta-receber/{id}/delete/{nf_codigo}', 'ContaReceberController@delete');
Route::post('/conta-receber/{id}/delete/{nf_codigo}', 'ContaReceberController@deletePost');

Route::get('/compra', 'CompraController@list');
Route::get('/compra/{id}/detalhe', 'CompraController@detalhe');
Route::get('/compra/create', 'CompraController@create');
Route::post('/compra/create', 'CompraController@createPost');
Route::get('/compra/{id}/clonar', 'CompraController@clonar');
Route::get('/compra/{id}/update', 'CompraController@update');
Route::post('/compra/{id}/update', 'CompraController@updatePost');
Route::get('/compra/{id}/delete', 'CompraController@delete');
Route::post('/compra/{id}/delete', 'CompraController@deletePost');

Route::get('/venda', 'VendaController@list');
Route::get('/venda/{id}/detalhe', 'VendaController@detalhe');
Route::get('/venda/create', 'VendaController@create');
Route::post('/venda/create', 'VendaController@createPost');
Route::get('/venda/{id}/update', 'VendaController@update');
Route::post('/venda/{id}/update', 'VendaController@updatePost');
Route::get('/venda/{id}/delete', 'VendaController@delete');
Route::post('/venda/{id}/delete', 'VendaController@deletePost');
