<?php

Route::get('/','Auth\LoginController@validacion');

Route::post('/login','Auth\LoginController@login')->name('login');
//Taxista
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
    //Todas las Rutas de Contacto
    Route::group(['prefix' => 'contacto'], function() {
        Route::get('/', 'InicioController@contacto')->name('contacto');
        Route::get('/taxistaMostrar', 'MostrarController@taxistaContacto')->name('mostrarTaxistaContacto');
        Route::get('/mostrar', 'MostrarController@contacto')->name('mostrarContacto');
        Route::get('/registrar', 'MostrarController@registrarContacto')->name('registrarContacto');
        Route::post('/add', 'RegistrarController@addContacto')->name('addContacto');
        Route::post('/editar', 'EditarController@editarContacto')->name('editarContacto');
        Route::post('/recuperar', 'ObtenerController@recuperarContacto')->name('recuperarContacto');
        Route::post('/eliminar', 'EliminarController@eliminarContacto')->name('eliminarContacto');
    });
    //Todas las Rutas de Cliente
    Route::get('/cliente', 'InicioController@cliente')->name('cliente');
    //Todas las Rutas de Vehiculo
    Route::get('/vehiculo', 'InicioController@vehiculo')->name('vehiculo');
});

Route::post('/logout','Auth\LogoutController@index')->name('logout');