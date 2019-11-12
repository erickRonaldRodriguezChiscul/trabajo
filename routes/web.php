<?php

Route::get('/','Auth\LoginController@validacion');

Route::post('/login','Auth\LoginController@login')->name('login');

Route::group(['prefix' => 'inicio'], function() {
    Route::get('/', 'InicioController@index')->name('inicio');
    //Todas las Rutas de Taxista
    Route::group(['prefix' => 'taxista'], function() {
        Route::get('/', 'InicioController@taxista')->name('taxista');
        Route::get('/mostrar', 'MostrarController@taxista')->name('mostrarTaxista');
        Route::get('/registrar', 'MostrarController@registrar')->name('registrarTaxista');
        Route::post('/add', 'RegistrarController@addTaxi')->name('addTaxista');
        Route::get('/editar', 'MostrarController@registrar')->name('editarTaxista');;
    });
    //Todas las Rutas de Cliente
    Route::get('/cliente', 'InicioController@cliente')->name('cliente');
    //Todas las Rutas de Vehiculo
    Route::get('/vehiculo', 'InicioController@vehiculo')->name('vehiculo');
});

Route::post('/logout','Auth\LogoutController@index')->name('logout');