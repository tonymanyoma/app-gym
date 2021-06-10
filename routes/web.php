<?php



Route::prefix('auth')->group(function () {


    // Create New User
    Route::post('register', 'AuthController@register');
    // Login User
    Route::post('login', 'AuthController@login');

    Route::post('login-facebook', 'LoginFacebookController@login');

    // Refresh the JWT Token
    Route::get('refresh', 'AuthController@refresh');

    // Below mention routes are available only for the authenticated users.
    Route::middleware('auth:api')->group(function () {
        // Get user info
        Route::get('user', 'AuthController@user');
        // Logout user from application
        Route::post('logout', 'AuthController@logout');

        //Clientes
        Route::resource('clientes', 'ClienteController');

        Route::post('crear_cliente', 'ClienteController@crear_cliente');
        Route::post('eliminar_cliente', 'ClienteController@eliminar_cliente');
        Route::post('actualizar_cliente', 'ClienteController@actualizar_cliente');
        Route::get('nombre_clientes', 'ClienteController@nombre_clientes');

        //Tipo documentos
        Route::resource('documentos', 'TipoDocumentoController');


        //Planes
        Route::resource('planes', 'PlanController');

        //Membresias
        Route::resource('membresias', 'MembresiaController');


        Route::post('crear_membresia', 'MembresiaController@crear_membresia');
        Route::post('renovar_membresia', 'MembresiaController@renovar_membresia');
        Route::post('eliminar_membresia', 'MembresiaController@eliminar_membresia');
        Route::get('generar_recibo/{id}', 'MembresiaController@generar_recibo');

        //Asistencias
        Route::resource('asistencias', 'AsistenciaController');
        Route::post('crear_asistencia', 'AsistenciaController@crear_asistencia');
        Route::post('eliminar_asistencia', 'AsistenciaController@eliminar_asistencia');

        //Reportes
        Route::post('reporte_asistencia', 'ReporteController@reporte_asistencia');
        Route::post('reporte_membresia', 'ReporteController@reporte_membresia');





});




});


Route::get('membresias_vencidas', 'MembresiaController@membresias_vencidas');

Route::get('prueba', 'MembresiaController@prueba');

Route::get('/{vue?}', function () {
    return view('index');
})->where('vue', '[\/\w\.-]*');
