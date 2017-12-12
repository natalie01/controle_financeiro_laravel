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

Auth::routes();


Route::resource('cliente','ClienteController');
Route::resource('fornecedor','FornecedorController');

Route::resource('contapagar','ContaPagarController');
Route::resource('contareceber','ContaReceberController');

Route::get('/baixa_conta_receber/{id?}','BaixaContaReceberController@baixa_receber');
Route::post('/baixa_receber_salvar/{id?}','BaixaContaReceberController@baixa_receber_salvar');

Route::get('/redirect', 'FacebookAuthController@redirect');
Route::get('/callback', 'FacebookAuthController@callback');

Route::get('/fluxocaixadatas', 'FluxoCaixaController@index');

Route::post('/fluxocaixa/resultado', 'FluxoCaixaController@resultado');

//Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'ContaReceberController@autocomplete'));

Route::get('autocomplete/{term?}','ContaReceberController@autocomplete');

Route::get('/novareceita','CaixaController@novareceita');
//Route::get('/incluir_novareceita','CaixaController@incluir_novareceita');
Route::get('/novadespesa','CaixaController@novadespesa');
//Route::get('/incluir_novadespesa','CaixaController@incluir_novadespesa');

Route::post('/incluir_novo_movim_caixa','CaixaController@incluir_novo_movim_caixa');

Route::get('/relatorio_caixa','CaixaController@index');
Route::post('/relatorio_caixa_pdf','CaixaController@mostrarPdf');



Route::get('selecionar_datas/{dt?}','CaixaController@selecionar_datas');//selecionar datas para filtar resultados
Route::post('/selecionar_datas_post','CaixaController@selecionar_datas_post');