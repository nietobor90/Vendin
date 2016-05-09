<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Categoria;
use Illuminate\Http\Request;
use File, Storage;
use Session;

class CategoriasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//            return view('admin/formCategoria');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            //retornamos vista nueva categoría
            return view('admin/registrarCategoria');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
            //cogemos imagen y sacamos su nombre
            $file = $request->file('imagen');
            $nombre = $file->getClientOriginalName();
            
            //Validación...
            
            //guardamos registro
            Categoria::create([
                'nombre' => $request['subcategoria'],
                'tipo' => $request['categoria'],
                'descripcion' => $request['descripcion'],
                'imagen' => $nombre,
            ]);
            
            //guardamos imagen
            Storage::put("categorias/$nombre", File::get($file));
            Session::flash('message', 'Se ha creado una nueva categoría. ');
            
            //Cogemos categorías de la base de datos ACTUALIZADAS y metemos en sesión
            $categorias = Categoria::all();
            Session::put('categorias', $categorias);
            //mostramos vista inicio
            return redirect('admin/categorias/create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            //seleccionamos productos de la categoria específica
            $categoria = Categoria::find($id);
            $productos = $categoria->productos()->get();
            //vista
            return view('admin/categoria')->with(['categoria'=>$categoria, 'productos'=>$productos]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            //cogemos categoría específica
            $categoria = Categoria::find($id);
            //retornamos vista
            return view('admin/editCategoria')
            ->with('categoria', $categoria);
            
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
            //Comprobamos si se ha enviado imagen
            if ($request->file('imagen')) {
                //cogemos imagen y sacamos su nombre
                $file = $request->file('imagen');
                $nombre = $file->getClientOriginalName();
                
                //Validación de datos enviados...
            
                //modificamos registro
                Categoria::where('id','=',$id)->update(array(
                    'nombre' => $request['subcategoria'],
                    'tipo' => $request['categoria'],
                    'descripcion' => $request['descripcion'],
                    'imagen' => $nombre,
                    ));
  
                //guardamos imagen nueva
                Storage::put("categorias/$nombre", File::get($file));
            } else {
                //modificamos registro
                Categoria::where('id','=',$id)->update(array(
                    'nombre' => $request['subcategoria'],
                    'tipo' => $request['categoria'],
                    'descripcion' => $request['descripcion'],
                    ));
            }
            
            //mensaje de aviso
            Session::flash('messageAviso', 'Se ha modificado la categoría '.$id.'.');

            //Cogemos categorías de la base de datos ACTUALIZADAS y metemos en sesión
            $categorias = Categoria::all();
            Session::put('categorias', $categorias);
            //mostramos vista inicio
            return view('admin/indexAdmin');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            //borramos categoria
            Categoria::destroy($id);
            //actualizamos
            $categorias = Categoria::all();
            Session::put('categorias', $categorias);
            
            Session::flash('messageBorradoCategoria', 'Se ha borrado una categoria. ');
            //vista
            return view('admin/indexAdmin');
	}

}
