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
        Route::get('/miniTaxistaMostrar', 'MostrarController@minitaxistaContacto')->name('mostrarMiniTaxistaContacto');
        Route::get('/registrar', 'MostrarController@registrarContacto')->name('registrarContacto');
        Route::post('/add', 'RegistrarController@addContacto')->name('addContacto');
        Route::post('/editar', 'EditarController@editarContacto')->name('editarContacto');
        Route::post('/recuperar', 'ObtenerController@recuperarContacto')->name('recuperarContacto');
        Route::post('/eliminar', 'EliminarController@eliminarContacto')->name('eliminarContacto');
    });
    //Todas las Rutas de Cliente
    Route::group(['prefix' => 'cliente'], function() {
        Route::get('/', 'InicioController@cliente')->name('cliente');
        Route::get('/mostrar', 'MostrarController@cliente')->name('mostrarCliente');
        Route::get('/registrar', 'MostrarController@registrarCliente')->name('registrarCliente');
        Route::post('/eliminar', 'EliminarController@eliminarCliente')->name('eliminarCliente');
        Route::post('/add', 'RegistrarController@addCliente')->name('addCliente');
        Route::post('/recuperar', 'ObtenerController@recuperarCliente')->name('recuperarCliente');
        Route::post('/editar', 'EditarController@editarCliente')->name('editarCliente');
    });
    //Todas las Rutas de Vehiculo
    Route::group(['prefix' => 'vehiculo'], function() {
        Route::get('/', 'InicioController@vehiculo')->name('vehiculo');
        Route::get('/mostrar', 'MostrarController@vehiculo')->name('mostrarVehiculo');
        Route::post('/eliminar', 'EliminarController@eliminarVehiculo')->name('eliminarVehiculo');
        Route::get('/registrar', 'MostrarController@registrarVehiculo')->name('registrarVehiculo');
        Route::post('/add', 'RegistrarController@addVehiculo')->name('addVehiculo');
        Route::post('/recuperar', 'ObtenerController@recuperarVehiculo')->name('recuperarVehiculo');
        Route::post('/editar', 'EditarController@editarVehiculo')->name('editarVehiculo');
    });
});

Route::post('/logout','Auth\LogoutController@index')->name('logout');