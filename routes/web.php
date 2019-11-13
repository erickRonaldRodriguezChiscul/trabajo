<?php

Route::get('/','Auth\LoginController@validacion');

Route::post('/login','Auth\LoginController@login')->name('login');

Route::group(['prefix' => 'inicio'], function() {
    Route::get('/', 'InicioController@index')->name('inicio');
    //Todas las Rutas de Taxista
    Route::group(['prefix' => 'taxista'], function() {
        Route::get('/', 'InicioController@taxista')->name('taxista');
        Route::get('/mostrar', 'MostrarController@taxista')->name('mostrarTaxista');
        Route::get('/registrar', 'MostrarController@registrarTaxista')->name('registrarTaxista');
        Route::post('/add', 'RegistrarController@addTaxi')->name('addTaxista');
        Route::post('/editar', 'EditarController@editarTaxista')->name('editarTaxista');
        Route::post('/recuperar', 'ObtenerController@recuperarTaxista')->name('recuperarTaxista');
        Route::post('/eliminar', 'EliminarController@eliminarTaxista')->name('eliminarTaxista');
    });
    //Todas las Rutas de Cliente
    Route::get('/cliente', 'InicioController@cliente')->name('cliente');
    //Todas las Rutas de Vehiculo
    Route::get('/vehiculo', 'InicioController@vehiculo')->name('vehiculo');
});

Route::post('/logout','Auth\LogoutController@index')->name('logout');