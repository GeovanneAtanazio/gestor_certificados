<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware'=>['auth','prevent-back-history']], function (){

    Route::get('/home', 'HomeController@teste');
    Route::resource('aluno', AlunoController::class)->only([
        'index', 'show'
    ]);
    Route::resource('certificado', CertificadoController::class)->except([
        'create','store'
    ]);
    Route::get('/certificado/create/{id}', 'CertificadoController@create')->name('certificado.create');
    Route::post('/certificado/{id}', 'CertificadoController@store')->name('certificado.store');

});

