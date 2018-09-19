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

Route::resource('celulas','CelulaController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('membros/show_da_celula/{celula_id}', 'MembrosCelulaController@showDaCelula')->name('membros.show_da_celula');
Route::get('membros/criar_membro_na_celula/{celula_id}', 'MembrosCelulaController@create')->name('criar_membro_na_celula');

// Só entra aqui se não funcionar nenhuma
Route::resource('membros','MembrosCelulaController');

//Route::get('membros/create/{celula_id}', 'MembrosCelulaController@create')->name('membros.create_da_celula');
