<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Mail;
use Auth;
use Session;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
                //a las acciones de middleware solo pueden acceder usuarios que han iniciado sesión
		$this->middleware('guest', ['except' => 'getLogout']);
	}
        
        //MÉTODO PARA VALIDAR Y REGISTRAR USUARIOS
        public function postRegister(Request $request) {
            //reglas
            $rules = [
                'name' => 'required|min:3|max:255|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
                'apellidos' => 'required|min:3|max:255|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6|max:60|confirmed',
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
                'email.unique' => 'El email ya existe',
                'password.required' => 'Este campo es requerido',
                'password.min' => 'El mínimo de caracteres permitidos son 6',
                'password.max' => 'El máximo de caracteres permitidos son 18',
                'password.confirmed' => 'El password no coincide',
            ];
            //validación
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if ($validator->fails()) {//si la validación da fallos...
                return redirect('auth/register')
                ->withErrors($validator)
                ->withInput();
            } else { //si no da ningun error
                //guardamos registro
                $user = new User;
                $data['name'] = $user->name = $request->name;
                $user->apellidos = $request->apellidos;
                $data['email'] =$user->email = $request->email;
                $user->password = bcrypt($request->password);
                $data['confirm_token'] = $user->remember_token = str_random(100);
                $user->save();
                $data['id'] = $user->id;
                
                //email de confirmación, plantilla guardada en la carpeta mails/register
                Mail::send('mails.register_confir', ['data' => $data], function($mail) use($data){
                    $mail->subject('Confirmación de cuenta en SkullBoom');
                    $mail->to($data['email'], $data['name']);
                });
                
                return redirect('auth/login')
                ->with('messageGood', 'Registro realizado, hemos enviado un mensaje de confirmación a su cuenta de correo');

            }
        }
        
        //MÉTODO PARA CONFIRMAR REGISTRO DE USUARIO POR EMAIL
        public function confirmRegister($id, $confirm_token){
            $user = new User;
            $the_user = $user->select()->where('id', '=', $id)
                    ->where('remember_token', '=', $confirm_token)->get();
            //si el usuario se encuentra en nuestra tabla...
            if (count($the_user) > 0) {
                $active = 1;
                //cambiamos token para que solo se verifique una vez q se ha vonfirmado el registro
                $nuevo_token = str_random(100);
                //actualizamos token del user 
                $user->where('id', '=', $id)
                     ->update(['active' => $active, 'remember_token' => $nuevo_token]);
                
                return redirect('auth/login')
                ->with('messageGood', 'Enhorabuena ' . $the_user[0]['name'] . ' ya puedes iniciar sesión');
            } else {
                return redirect('');
            }
            
        }
        
        //MÉTODO PARA LOGIN DE USUARIO
        public function postLogin(Request $request) {
            if(Auth::attempt( //si el usuario es válido
                    [
                    'email' => $request->email,
                    'password' =>$request->password,
                    'active' => 1
                    ]
                    , $request->has('remember')
                    )){
//                return redirect()->intended($this->redirectPath());
            if (Auth::user()->id == 12) {
                return redirect('admin');
            }
                
                return redirect('/');//reddireccionamos a página de inicio
            } else { // si el usuario no es válido...
                $rules = [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
                
                $messages = [
                    'email.required' => 'El campo email es requerido',
                    'email.email' => 'El formato del email es incorrecto',
                    'password.required' => 'El campo password es requerido',
                ];
                
                //validación
                $validator = Validator::make($request->all(), $rules, $messages);
                
                return redirect('auth/login')
                ->withErrors($validator)
                ->withInput()
                ->with('messageError','Error al iniciar sesión');
             
            }
                
        }
        
}
