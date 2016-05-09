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
//		return view('registro');
	}

	/**
	 GUARDAR UN RECURSO RECIEN CREADO EN EL ALMACENAMIENTO
	 */
	public function store(Request $request){
//            //datos
//            $data = Requests::all();
//            //reglas
//            $rules = array(
//                'name' => 'required', 
//                'email' => 'required', 
//                'password' => 'required', 
//                'apellidos' => 'required'
//            );            
//            //validar datos
//            $v = Validator::make($data, $rules);
//            
//            //si la validación encuentra fallos
//            if ($v->fails()) {
//                return redirect()->back()
//                       ->withErrors($v->errors())
//                       ->withInput(Requests::except('password'));
//            }
//            
//            \App\User::create([
//                'name' => $request['nombre'],
//                'apellidos' => $request['ape'],
//                'email' => $request['mail'],
//                'password' => bcrypt($request['pwd2']),
//                ]);
//            
//            //mostrar vsita de login
//            return view('login');
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
            'apellidos' => 'required|min:3|max:255|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255',
            ];
            //mensajes
            $messages = [
                'name.required' => 'Este campo es requerido',
                'name.min' => 'El mínimo de caracteres permitidos son 3',
                'name.max' => 'El máximo de caracteres permitidos son 16',
                'name.regex' => 'Sólo se aceptan letras',
                'apellidos.required' => 'Este campo es requerido',
                'apellidos.min' => 'El mínimo de caracteres permitidos son 3',
                'apellidos.max' => 'El máximo de caracteres permitidos son 16',
                'apellidos.regex' => 'Sólo se aceptan letras',
                'email.required' => 'Este campo es requerido',
                'email.email' => 'El formato de email es incorrecto',
                'email.max' => 'El máximo de caracteres permitidos son 255',
            ];
            //validación
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if($validator->fails()){//si la validación falla
                return redirect('usuario/perfil_user')
                ->withErrors($validator);
            } else {//si no falla
                $user = new User;
                $user->where('name', '=', Auth::user()->name)
                        ->update(['name'=> $request->name, 'apellidos'=> $request->apellidos, 'email'=> $request->email]);
                
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
                ->with('messageAviso', 'Su usuario ha sido borrado, esperamos volver a verle pronto, un saludos desde SkullBoom.');
	}

}
