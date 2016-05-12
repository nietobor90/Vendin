<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Anuncio;
use App\Categoria;
use App\Auth;
use File, Storage;
use Session;
use Validator;

class AnunciosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//reglas
            $rules = [
            	'imagen' => 'required',
                'titulo' => 'required|min:3|max:255',
                'descripcion' => 'required|min:3|max:255',
                'precio' => 'required|numeric',
                'categoria' => 'required',
            ];
            //mensajes
            $messages = [
            	'imagen.required' => 'Este campo es requerido',
                'titulo.required' => 'Este campo es requerido',
                'titulo.min' => 'El mínimo de caracteres permitidos son 3',
                'titulo.max' => 'El máximo de caracteres permitidos son 16',
                'descripcion.required' => 'Este campo es requerido',
                'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
                'descripcion.max' => 'El máximo de caracteres permitidos son 16',
                'precio.required' => 'Este campo es requerido',
                'precio.numeric' => 'Sólo se aceptan numeros',
                'categoria.required' => 'Este campo es requerido',
            ];
            //validación
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if ($validator->fails()) {//si la validación da fallos...
                return redirect('/publicar')
                ->withErrors($validator)
                ->withInput()
                ->with('messageError', 'No podemos dar de alta su anuncio, porfavor compruebe los campos con errores.');;
            } else {//Si la validación no tiene fallos...
            	//cogemos imagen y sacamos su nombre
                $file = $request->file('imagen');
                //añadimos ruta repositorio imagenes de anuncios
                $nombre = "img/anuncios/".$file->getClientOriginalName();
                //sacamos clave foranea de la categoría
                $categoria_id = Categoria::select('id')->where('nombre', '=', $request['categoria'])->get();

                //Validación de datos enviados...

                //guardamos nuevo Anuncio
                 Anuncio::create([
                    'titulo' => $request['titulo'],
                    'descripcion' => $request['descripcion'],
                    'categoria' => $categoria_id[0]->id,
                    'precio' => $request['precio'],
                    'user' => $_POST['idUser'],
                ]);
                
                // $nombreImagen = $file->getClientOriginalName(); 
                $nombreImagen =  $request['titulo'].".jpg";
                //guardamos imagen nueva
                Storage::put("anuncios/$nombreImagen", File::get($file));
            
            	//mensaje de aviso
	            return redirect("modificar")
	            ->with('messageGood', 'Se ha registrado el anuncio '.$request['titulo'].'.');
            }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//cogemos anuncio específico
            $productoArray = Anuncio::where('id','=',$id)->get();
            $producto = $productoArray[0];
            
            //retornamos vista
            return view('anuncio/anuncioModificar')
            ->with('producto', $producto);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id , Request $request)
	{
		//reglas
            $rules = [
                'titulo' => 'required|min:3|max:255|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
                'descripcion' => 'required|min:3|max:255',
                'precio' => 'required|numeric',
                'categoria' => 'required',
            ];
            //mensajes
            $messages = [
                'titulo.required' => 'Este campo es requerido',
                'titulo.min' => 'El mínimo de caracteres permitidos son 3',
                'titulo.max' => 'El máximo de caracteres permitidos son 16',
                'titulo.regex' => 'Sólo se aceptan letras',
                'descripcion.required' => 'Este campo es requerido',
                'descripcion.min' => 'El mínimo de caracteres permitidos son 3',
                'descripcion.max' => 'El máximo de caracteres permitidos son 16',
                'precio.required' => 'Este campo es requerido',
                'precio.numeric' => 'Sólo se aceptan numeros',
                'categoria.required' => 'Este campo es requerido',
            ];
            //validación
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if ($validator->fails()) {//si la validación da fallos...
            	//cogemos anuncio específico
		            $productoArray = Anuncio::where('id','=',$id)->get();
		            $producto = $productoArray[0];

		        //mensaje de aviso
            	Session::flash('messageErrorModificar', 'No podemos modificar su anuncio, porfavor compruebe los campos con errores.');
                
                return view('anuncio/anuncioModificar')
                ->withErrors($validator)
                ->with('producto', $producto);

            } else {//Si la validación no tiene fallos...

            	//cogemos anuncio antiguo y sacamos su titulo para poder borrar su imagen
            	$anuncioAntiguo = Anuncio::where('id','=',$id)->get();
            	//sacamos clave foranea de la categoría
		        $categoria_id = Categoria::select('id')->where('nombre', '=', $request['categoria'])->get();

            	//Comprobamos si se ha enviado imagen
            	if ($request->file('imagen')) {
		            	//cogemos imagen y sacamos su nombre
		                $file = $request->file('imagen');
		                //añadimos ruta repositorio imagenes de anuncios
		                $nombre = "img/anuncios/".$file->getClientOriginalName();
		                

		                //modificamos Anuncio
		                 Anuncio::where('id', '=', $id)->update(array(
		                    'titulo' => $request['titulo'],
		                    'descripcion' => $request['descripcion'],
		                    'categoria' => $categoria_id[0]->id,
		                    'precio' => $request['precio'],
		                ));
		                
		                // $nombreImagen = $file->getClientOriginalName(); 
		                $nombreImagen =  $request['titulo'].".jpg";
		                //guardamos imagen nueva
		                Storage::put("anuncios/$nombreImagen", File::get($file));
		                //comprobar si se ha modificado el titulo del anuncio
			            if($anuncioAntiguo[0]->titulo != $request['titulo']){
			            	//borramos imagen antigua   
			            	Storage::delete('anuncios/'.$anuncioAntiguo[0]->titulo.'.jpg');
			            }

		            	//mensaje de aviso
			            return redirect("modificar")
			            ->with('messageGood', 'Se ha modificado el anuncio '.$request['titulo'].'.');

            	} else {
            		//ACTUALIZAR IMGAEN ANTIGUA DEL ANUNCIO 
            		//cogemos imagen del sistema
		            $rutaImgAntigua = 'anuncios/'.$anuncioAntiguo[0]->titulo.'.jpg';   
		            $imagenAntigua = Storage::get($rutaImgAntigua); 
		            //guardamos con nombre nuevo	
		            $nombreImagen =  $request['titulo'].".jpg";
		            //guardamos imagen nueva utilizando la anterior
		            Storage::put("anuncios/$nombreImagen", $imagenAntigua);
		            //comprobar si se ha modificado el titulo del anuncio
		            if($anuncioAntiguo[0]->titulo != $request['titulo']){
		            	//borramos imagen antigua   
		            	Storage::delete('anuncios/'.$anuncioAntiguo[0]->titulo.'.jpg');
		            }
		            

		                //modificamos Anuncio
		                 Anuncio::where('id', '=', $id)->update(array(
		                    'titulo' => $request['titulo'],
		                    'descripcion' => $request['descripcion'],
		                    'categoria' => $categoria_id[0]->id,
		                    'precio' => $request['precio'],
		                ));

		            return redirect("modificar")
	            	->with('messageGood', 'Se ha modificado el anuncio '.$request['titulo'].'.');     	


		                
            }
        }
            	
// 		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
