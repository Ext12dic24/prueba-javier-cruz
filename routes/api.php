<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group([], function () {
    //Rutas publicas sin autenticacion
    Route::post('entrar', 'App\Http\Controllers\AuthController@entrar');
    Route::post('registro', 'App\Http\Controllers\AuthController@registro');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        //Rutas privadas que requieren autenticacion

        Route::get('salir', 'App\Http\Controllers\AuthController@salir');

        //CRUD usuarios
        Route::get('read-usuario/{id}', 'App\Http\Controllers\UsuariosController@read1');
        Route::get('read-usuarios', 'App\Http\Controllers\UsuariosController@read2');
        Route::post('update-usuario/{id}', 'App\Http\Controllers\UsuariosController@update');
        Route::get('delete-usuario/{id}', 'App\Http\Controllers\UsuariosController@delete');

        //CRUD corporativos
        Route::post('create-corporativo', 'App\Http\Controllers\CorporativosController@create');
        Route::get('read-corporativo/{id}', 'App\Http\Controllers\CorporativosController@read1');
        Route::get('read-corporativos', 'App\Http\Controllers\CorporativosController@read2');
        Route::post('update-corporativo/{id}', 'App\Http\Controllers\CorporativosController@update');
        Route::get('delete-corporativo/{id}', 'App\Http\Controllers\CorporativosController@delete');

        //CRUD empresas corporativos
        Route::post('create-empresa-corporativo', 'App\Http\Controllers\EmpresasCorporativosController@create');
        Route::get('read-empresa-corporativo/{id}', 'App\Http\Controllers\EmpresasCorporativosController@read1');
        Route::get('read-empresas-corporativos', 'App\Http\Controllers\EmpresasCorporativosController@read2');
        Route::post('update-empresa-corporativo/{id}', 'App\Http\Controllers\EmpresasCorporativosController@update');
        Route::get('delete-empresa-corporativo/{id}', 'App\Http\Controllers\EmpresasCorporativosController@delete');

        //CRUD contactos corporativos
        Route::post('create-contacto', 'App\Http\Controllers\ContactosCorporativosController@create');
        Route::get('read-contacto/{id}', 'App\Http\Controllers\ContactosCorporativosController@read1');
        Route::get('read-contactos', 'App\Http\Controllers\ContactosCorporativosController@read2');
        Route::post('update-contacto/{id}', 'App\Http\Controllers\ContactosCorporativosController@update');
        Route::get('delete-contacto/{id}', 'App\Http\Controllers\ContactosCorporativosController@delete');

        //CRUD contratos corporativos
        Route::post('create-contrato', 'App\Http\Controllers\ContratosCorporativosController@create');
        Route::get('read-contrato/{id}', 'App\Http\Controllers\ContratosCorporativosController@read1');
        Route::get('read-contratos', 'App\Http\Controllers\ContratosCorporativosController@read2');
        Route::post('update-contrato/{id}', 'App\Http\Controllers\ContratosCorporativosController@update');
        Route::get('delete-contrato/{id}', 'App\Http\Controllers\ContratosCorporativosController@delete');

        //CRUD documentos
        Route::post('create-documento', 'App\Http\Controllers\DocumentosController@create');
        Route::get('read-documento/{id}', 'App\Http\Controllers\DocumentosController@read1');
        Route::get('read-documentos', 'App\Http\Controllers\DocumentosController@read2');
        Route::post('update-documento/{id}', 'App\Http\Controllers\DocumentosController@update');
        Route::get('delete-documento/{id}', 'App\Http\Controllers\DocumentosController@delete');

        //CRUD documentos corporativos
        Route::post('create-documento-corporativo', 'App\Http\Controllers\DocumentosCorporativosController@create');
        Route::get('read-documento-corporativo/{id}', 'App\Http\Controllers\DocumentosCorporativosController@read1');
        Route::get('read-documentos-corporativos', 'App\Http\Controllers\DocumentosCorporativosController@read2');
        Route::post('update-documento-corporativo/{id}', 'App\Http\Controllers\DocumentosCorporativosController@update');
        Route::get('delete-documento-corporativo/{id}', 'App\Http\Controllers\DocumentosCorporativosController@delete');


    });
});

Route::group([
    'middleware' => 'api', 
    'prefix' => 'password'
], function () {    
    Route::post('create', 'App\Http\Controllers\PasswordResetController@create');
    Route::get('find/{token}', 'App\Http\Controllers\PasswordResetController@find');
    Route::post('reset', 'App\Http\Controllers\PasswordResetController@reset');
});
