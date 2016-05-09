<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::controllers([
//	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Página de inicio
//Route::get('/', 'InicioController@index');
Route::resource('/', 'InicioController');
Route::get('/home', 'InicioController@index');

//Página de marcas
Route::get('/marcas','InicioController@marcas');

//REGISTRO Y AUTENTICACIÓN DE USUARIO
Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register','Auth\AuthController@postRegister');
//
////LOGIN AUTENTICACIÓN Y LOGOUT
Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@postLogin');
Route::get('auth/logout','Auth\AuthController@getLogout');//salir de la sesión de usuario
//ruta para la confirmación de registro del user
Route::get('auth/confirm/id/{id}/confirm_token/{confirm_token}','Auth\AuthController@confirmRegister');
//Route::resource('auth', 'AuthController');

///////////////////////////////////USUARIO//////////////////////////////////////
//Perfil de usuario
//Route::get('user/perfil_user', 'UsuarioController@index');//página de login
Route::post('usuario/perfil_user', 'UsuarioController@update');//modificación user
//Borrar usuario
//Route::delete('usuario.destroy','UsuarioController@destroy');
Route::resource('usuario','UsuarioController');

//BUSCADOR
Route::get('home/searchredirect', function(){
    /*si el argumento search está vacío, regresar a la página anterior */
    if (empty(Input::get('search'))) return redirect()->back();
    
    $search = urlencode(e(Input::get('search')));
    $route = "home/search/$search";
    return redirect($route);        
});
Route::get("home/search/{search}","InicioController@search");

//ORDENAR
//ordenar productos del resultado de busqueda especifica
Route::get("home/ordenar/search","InicioController@ordenarBusqueda");
//ordenar productos de una determinada categoria
Route::get("home/ordenar/{categoria}","InicioController@ordenarCategoria");

//PRODUCTOS
//visualizar producto específico (VISTA PRODUCTO)
//Route::get("producto/{producto_id}", "ProductosController@show");
Route::resource('producto', 'ProductosController',
                ['only' => ['show']]);

//Rutas para CATEGORÍAS
//Route::get("categoria/{id}","CategoriasController@show");
Route::resource('categoria', 'CategoriasController',
                ['only' => ['show']]);

//Mostrar productos rebajados desde el menú de inicio
Route::get("rebajas","InicioController@rebajas");

//ENLACES PIE DE PÁGINA
Route::get("enlaces/preguntas", "InicioController@preguntas");
Route::get("enlaces/ayuda", "InicioController@ayuda");
Route::get("enlaces/nosotros", "InicioController@nosotros");
Route::get("enlaces/contacto", "InicioController@contacto");
Route::get("enlaces/legal", "InicioController@legal");
Route::get("enlaces/politica", "InicioController@politica");

//MAPA DE GOOGLE CON SOAP
Route::get("mapa", "SoapController@mapa");
//Route::get('/mapa', ['as' => 'mapa', 'uses' => 'SoapController@mapa']);

//RUTAS ADMIN
Route::get('admin','InicioController@administrador');
Route::resource("admin/categorias", "Admin\CategoriasController");
Route::resource("admin/productos", "Admin\ProductosController");

///////////////////////////////////////////////////////////////////////////////////////////////////////////////


//ejemplos de rutas resource personalizadas
//Route::resource('photo', 'PhotoController',
//                ['only' => ['index', 'show']]);
//
//Route::resource('photo', 'PhotoController',
//                ['except' => ['create', 'store', 'update', 'destroy']]);