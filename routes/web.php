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
    return redirect('home');
});

Route::get('home', 'HomeController@index');

Route::get('/empresa', 'EmpresaController@empresa');
Route::post('/empresa_salvar', 'EmpresaController@empresa_salvar');
Route::get('/empresa_editar/{id?}', 'EmpresaController@empresa_editar');
Route::put('/empresa_update/{id?}', 'EmpresaController@empresa_update');

Auth::routes();

Route::resource('cliente','ClienteController');
Route::resource('fornecedor','FornecedorController');

Route::resource('despesas_fixas','DespesasFixasController');

Route::resource('contapagar','ContaPagarController');
Route::resource('contareceber','ContaReceberController');

Route::post('/selecionar_datas_contas_receber','ContaReceberController@selecionar_datas_contas_receber');
Route::post('/selecionar_datas_contas_pagar','ContaPagarController@selecionar_datas_contas_pagar');

Route::get('/baixa_conta_receber/{id?}','BaixaContaReceberController@baixa_receber');
Route::post('/baixa_receber_salvar/{id?}','BaixaContaReceberController@baixa_receber_salvar');

Route::get('/baixa_conta_pagar/{id?}','BaixaContaPagarController@baixa_pagar');
Route::post('/baixa_pagar_salvar/{id?}','BaixaContaPagarController@baixa_pagar_salvar');

Route::get('/redirect', 'FacebookAuthController@redirect');
Route::get('/callback', 'FacebookAuthController@callback');

Route::get('/fluxocaixadatas', 'FluxoCaixaController@index');

Route::post('/fluxocaixa/resultado', 'FluxoCaixaController@resultado');

Route::get('autocomplete/{term?}','ContaReceberController@autocomplete');

Route::get('/novareceita','CaixaController@novareceita');

Route::get('/novadespesa','CaixaController@novadespesa');

Route::get('/novo_mov_caixa','CaixaController@novo_mov_caixa');


Route::post('/incluir_novo_movim_caixa','CaixaController@incluir_novo_movim_caixa');

Route::get('/relatorio_caixa','CaixaController@index');

Route::post('/caixa_excluir/{id?}','CaixaController@excluir');

Route::get('/caixa_excluir/{id?}', function () {
    return redirect()->action('CaixaController@index');
});


Route::get('selecionar_datas/{dt?}','CaixaController@selecionar_datas');//selecionar datas para filtar resultados
Route::post('/selecionar_datas_post','CaixaController@selecionar_datas_post');