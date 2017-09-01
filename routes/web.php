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

// Authentication Routes...
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('alunos', 'AlunosController');
    Route::get('teachers/payments', 'PaymentsController@index')->name("payments.index");
    Route::put('teachers/payments/{teacherPayment}', 'PaymentsController@quitar')->name("payments.quitar");
    Route::resource('teachers', 'TeachersController');
    Route::get('turmas/grade', 'TurmasController@showGrade')->name("turmas.grade");
    Route::resource('turmas', 'TurmasController');

    Route::put('contratos/{contrato}/desativar', 'ContratosController@desativar')->name('contratos.desativar');
    Route::resource('contratos', 'ContratosController');
    Route::post('mensalidades', 'MensalidadesController@store')->name('mensalidades.store');
    Route::put('mensalidades/{mensalidade}', 'MensalidadesController@update')->name('mensalidades.update');
    Route::put('mensalidades/desquitar/{mensalidade}', 'MensalidadesController@desquitar')->name('mensalidades.desquitar');
    Route::delete('mensalidades/{mensalidade}', 'MensalidadesController@destroy')->name('mensalidades.destroy');
    Route::post('mensalidades/quitar', 'MensalidadesController@quitar')->name('mensalidades.quitar');
    Route::resource('despesas', 'DespesasController');
    Route::resource('produtos', 'ProdutosController');
    Route::resource('vendas', 'VendasController');
    Route::match(['get', 'post'],"relatorio/venda",'RelatoriosController@venda')->name('relatorio.venda');
    Route::match(['get', 'post'],"relatorio/contrato",'RelatoriosController@contrato')->name('relatorio.contrato');
    Route::match(['get', 'post'],"relatorio/mensalidade",'RelatoriosController@mensalidade')->name('relatorio.mensalidade');
    Route::match(['get', 'post'],"relatorio/geral",'RelatoriosController@geral')->name('relatorio.geral');
});




