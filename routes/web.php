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
    return view('welcome');
});

Auth::routes();

Route::get('/painel', 'Painel\PainelController@index')->name('painel.index');/* php  */

Route::get('/produtos','Painel\Produto\ProdutoController@indexView')->name('paine.produtos.index');

Route::get('/vendas','Painel\Vendas\VendasController@indexView')->name('paine.vendas.index');
Route::get('/vendas/show/{id}','Painel\Vendas\VendasController@show')->name('paine.vendas.show');

Route::get('/usuarios','Painel\Usuarios\UsuariosController@index')->name('usuarios.index');
Route::get('/usuarios/create','Painel\Usuarios\UsuariosController@create')->name('painel.usuarios.create');
Route::get('/usuarios/show','Painel\Usuarios\UsuariosController@show')->name('painel.usuarios.show');

Route::get('/usuarios/edit/{id}','Painel\Usuarios\UsuariosController@edit')->name('usuarios.editar');
Route::get('/usuarios/delete/{id}','Painel\Usuarios\UsuariosController@atualizarStatus')->name('usuarios.status');

Route::get('/estoque','Painel\Produtos\EstoqueController@index')->name('estoque.index');
Route::get('/entradas','Painel\Produtos\EntradaController@index')->name('entrada.index');
Route::get('/saidas','Painel\Produtos\SaidasController@index')->name('saida.index');

Route::post('/usuarios/store','Painel\Usuarios\UsuariosController@store')->name('usuarios.store');
Route::post('/usuarios/update/{id}','Painel\Usuarios\UsuariosController@update')->name('usuarios.update');

Route::post('/vendas/cadVendas', 'Painel\Vendas\VendasController@cadVendas' )->name('vendas.cadVendas');
Route::post('/vendas/imprimir/', 'Painel\Vendas\VendasController@ImprimirRecibo' )->name('vendas.imprimir');

Route::post('/produtos/XMLProduto', 'Painel\Produto\ProdutoController@XMLProduto' )->name('produto.XMLProduto');
Route::post('/produtos/porcentagem', 'Painel\Produto\ProdutoController@aplicarPorcentagem' )->name('produto.porcentagem');
