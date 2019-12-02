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
        //revision tecnica
        Route::get('/revision', 'InicioController@revision')->name('revision');
        Route::get('/mostrarRevision', 'MostrarController@vehiculoRevision')->name('mostrarVehiculoRevision');
        Route::post('/recuperarRevision', 'ObtenerController@recuperarRevision')->name('recuperarRevision');
        Route::post('/addRevision', 'RegistrarController@addRevision')->name('addRevision');
        Route::post('/editarRevision', 'EditarController@editarRevision')->name('editarRevision');
        //revision soat
        Route::get('/soat', 'InicioController@soat')->name('soat');
        Route::post('/recuperarSoat', 'ObtenerController@recuperarSoat')->name('recuperarSoat');
        Route::post('/addSoat', 'RegistrarController@addSoat')->name('addSoat');
        Route::post('/editarSoat', 'EditarController@editarSoat')->name('editarSoat');
        //revision seguro
        Route::get('/seguro', 'InicioController@seguro')->name('seguro');
        Route::post('/recuperarSeguro', 'ObtenerController@recuperarSeguro')->name('recuperarSeguro');
        Route::post('/addSeguro', 'RegistrarController@addSeguro')->name('addSeguro');
        Route::post('/editarSeguro', 'EditarController@editarSeguro')->name('editarSeguro');
    });

    Route::group(['prefix' => 'configuracion'], function() {
        Route::get('/', 'InicioController@configuracion')->name('configuracion');
        Route::post('/cambiar', 'EditarController@editarConfiguracion')->name('editarConfiguracion');
    });

    Route::group(['prefix' => 'dato'], function() {
        Route::get('/', 'InicioController@dato')->name('dato');
        Route::get('/mostrar', 'MostrarController@dato')->name('mostrarDato');
        Route::post('/eliminar', 'EliminarController@eliminarDato')->name('eliminarDato');
        Route::get('/registrar', 'MostrarController@registrarDato')->name('registrarDato');
        Route::post('/add', 'RegistrarController@addDato')->name('addDato');
    });

    Route::group(['prefix' => 'servicio'], function() {
        Route::get('/', 'InicioController@servicio')->name('servicio');
        Route::get('/mostrar', 'MostrarController@servicio')->name('mostrarServicio');
        Route::post('/cambiar', 'EditarController@editarConfiguracion')->name('editarConfiguracion');
        Route::get('/registrar', 'MostrarController@registrarServicio')->name('registrarServicio');
        Route::post('/add', 'RegistrarController@addServicio')->name('addServicio');
        Route::post('/recuperar', 'ObtenerController@recuperarServicio')->name('recuperarServicio');
        Route::post('/editar', 'EditarController@editarServicio')->name('editarServicio');
    });

    Route::group(['prefix' => 'programacion'], function() {
        Route::get('/', 'InicioController@programacion')->name('programacion');
        Route::get('/mostrarPersona', 'MostrarController@minitaxistaProgramacion')->name('mostrarPersonaProgra');
        Route::get('/mostrarServicio', 'MostrarController@miniServicioProgramacion')->name('mostrarServicioProgra');
        Route::post('/add', 'RegistrarController@addProgramacion')->name('addProgramacion');
    });
});

Route::post('/logout','Auth\LogoutController@index')->name('logout');

Route::get('/img','ImgController@recuperarDireccion');
