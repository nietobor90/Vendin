<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\AuthController;

class UsuarioController extends Controller {
    
        public function __construct()
	{
                $this->middleware('auth');
	}

	/**
	MOSTRAR EL ESTADO DE LOS RECURSOS
	 */
	public function index()
	{
		return view('user.perfil_user');
	}

	/**
	 MUESTRA EL FORMULARIO PARA CREAR EL RECURSO
	 */
	public function create()
	{

	}

	/**
	 GUARDAR UN RECURSO RECIEN CREADO EN EL ALMACENAMIENTO
	 */
	public function store(Request $request){
//            
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        //mandamos a perfil del usuario
		return view('user/perfil_user');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
            //reglas 
            $rules = [
            'name' => 'required|min:3|max:255|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'apellido' => 'required|min:3|max:255|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            ];
            //mensajes
            $messages = [
                'name.required' => 'Este campo es requerido',
                'name.min' => 'El mínimo de caracteres permitidos son 3',
                'name.max' => 'El máximo de caracteres permitidos son 16',
                'name.regex' => 'Sólo se aceptan letras',
                'apellido.required' => 'Este campo es requerido',
                'apellido.min' => 'El mínimo de caracteres permitidos son 3',
                'apellido.max' => 'El máximo de caracteres permitidos son 16',
                'apellido.regex' => 'Sólo se aceptan letras',
                'email.required' => 'Este campo es requerido',
                'email.email' => 'El formato de email es incorrecto',
                'email.max' => 'El máximo de caracteres permitidos son 255',
            ];
            //validación
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if($validator->fails()){
                return redirect('usuario/perfil_user')
                ->withErrors($validator)
                ->withInput()
                ->with('messageError', 'Error al modificar sus datos, revise los campos con errores.');
            } else {//si no falla
                $user = new User;
                $user->where('name', '=', Auth::user()->name)
                        ->update(['name'=> $request->name, 'apellidos'=> $request->apellido, 'email'=> $request->email]);
                
                return redirect('usuario/perfil_user')
                ->with('messageGood', 'Datos actualizados correctamente');

            }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            //destruimos usuario
            User::destroy($id);
            
            //redireccionamos
            return redirect('/')
                ->with('messageAviso', 'Su usuario ha sido borrado, esperamos volver a verle pronto, un saludos desde Vendin.');
	}

}
