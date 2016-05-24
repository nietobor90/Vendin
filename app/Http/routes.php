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
//atajos
Route::controllers([
// 	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
//NUEVAS
Route::get("publicar", "InicioController@publicarAnuncio");
Route::get("modificar", "InicioController@modificarAnuncio");
Route::resource("anuncios", "AnunciosController");
Route::get("view/{producto_id}", "AnunciosController@show");
Route::get("update/{producto_id}", "AnunciosController@edit");
Route::post("contact", "AnunciosController@contact");
Route::resource('anuncio','AnunciosController');

//BUSCADOR
Route::get('home/searchredirect', function(){
    /*si el argumento search está vacío, regresar a la página anterior */
    if (empty(Input::get('search'))) return redirect()->back();
    
    $search = urlencode(e(Input::get('search')));
    $categoria = urlencode(e(Input::get('categoria')));
    $route = "home/search/$search/$categoria";
    return redirect($route);        
});
Route::get("home/search/{search}/{categoria}","InicioController@search");

/////////////////////////////////////////////////////////////////////////////////////

Route::resource('anuncio', 'AnunciosController',
                ['only' => ['show']]);
Route::resource("productos", "AnunciosController");

//Página de inicio
Route::resource('/', 'InicioController');
Route::get('/home', 'InicioController@index');

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
Route::resource('auth', 'AuthController');

///////////////////////////////////USUARIO//////////////////////////////////////
Route::post('usuario/perfil_user', 'UsuarioController@update');//modificación user
Route::resource('usuario','UsuarioController');

//Rutas para CATEGORÍAS
Route::resource('categoria', 'CategoriasController',
                ['only' => ['show']]);
//cookies
Route::resource('cookies', 'InicioController@cookies');
//enlaces
Route::resource('ayuda', 'InicioController@ayuda');
Route::resource('politica', 'InicioController@politica');
Route::resource('condiciones', 'InicioController@condiciones');

//RUTAS ADMIN
// **********


///////////////////////////////////////////////////////////////////////////////////////////////////////////////



