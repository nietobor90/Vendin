<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Producto;
use Illuminate\Http\Request;
use File, Storage;
use Session;

class ProductosController extends Controller {

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
            //generar categorías
            //nombres de categorías y tipos diferentes
            $categoriasPadre = Categoria::distinct()->select('nombre', 'tipo')->get();
            //tipo de producto
            $tipos = Categoria::distinct()->select('tipo')->get();
            //retornamos vista nuevo producto
            return view('admin/registrarProducto')
            ->with('categoriasPadre' , $categoriasPadre)
            ->with('tipos', $tipos);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
            //Comprobamos si se ha enviado imagen
            if ($request->file('imagen')) {
                //cogemos imagen y sacamos su nombre
                $file = $request->file('imagen');
                //añadimos ruta repositorio imagenes de productos
                $nombre = "img/productos/".$file->getClientOriginalName();
                
                //sacamos clave foranea de la categoría
                $categoria_id = Categoria::select('id')->where('nombre', '=', $request['categoria'])->where('tipo','=',$request['tipo'])->get();

                //Validación de datos enviados...
            
                 //guardamos registro
                 Producto::create([
                    'nombre' => $request['nombre'],
                    'descripcion' => $request['descripcion'],
                    'tipo' => substr ($request['tipo'], 0, 1),
                    'precio' => $request['precio'],
                    'unidades' => $request['unidades'],
                    'marca' => $request['marca'],
                    'rebaja' => $request['rebaja'],
                    'imagen' => $nombre,
                    'categoria_id' => $categoria_id[0]->id,
                ]);
                
                $nombreImagen = $file->getClientOriginalName(); 
                //guardamos imagen nueva
                Storage::put("productos/$nombreImagen", File::get($file));
            } else {
                //sacamos clave foranea de la categoría
                $categoria_id = Categoria::select('id')->where('nombre', '=', $request['categoria'])->where('tipo','=',$request['tipo'])->get();

                //Validación de datos enviados...
            
                 //guardamos registro
                 Producto::create([
                    'nombre' => $request['nombre'],
                    'descripcion' => $request['descripcion'],
                    'tipo' => substr ($request['tipo'], 0, 1),
                    'precio' => $request['precio'],
                    'unidades' => $request['unidades'],
                    'marca' => $request['marca'],
                    'rebaja' => $request['rebaja'],
                    'categoria_id' => $categoria_id[0]->id,
                ]);
            }
            
            //mensaje de aviso
            Session::flash('messageProducto', 'Se ha registrado el producto '.$request['nombre'].'.');

            //Cogemos categorías de la base de datos ACTUALIZADAS y metemos en sesión
            $categorias = Categoria::all();
            Session::put('categorias', $categorias);
            
            //seleccionamos productos de la categoria específica
            $categoria = Categoria::all()->last();
            $productos = $categoria->productos()->paginate(8);
            //vista
//            return view('admin/categoria')->with(['categoria'=>$categoria, 'productos'=>$productos]);
             return redirect("admin/categorias/".$categoria_id[0]->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            //cogemos producto específico
            $productoArray = Producto::where('id','=',$id)->get();
            $producto = $productoArray[0];
            //nombres de categorías y tipos diferentes
            $categoriasPadre = Categoria::distinct()->select('nombre', 'tipo')->get();
            //tipo de producto
            $tipos = Categoria::distinct()->select('tipo')->get();
            
            //retornamos vista
            return view('admin/editProducto')
            ->with('producto', $producto)
            ->with('categoriasPadre' , $categoriasPadre)
            ->with('tipos', $tipos);
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
                //añadimos ruta repositorio imagenes de productos
                $nombre = "img/productos/".$file->getClientOriginalName();
                
                //sacamos clave foranea de la categoría
                $categoria_id = Categoria::select('id')->where('nombre', '=', $request['categoria'])->where('tipo','=',$request['tipo'])->get();

                //Validación de datos enviados...
            
                 //modificamos registro
                 Producto::where('id', '=', $id)->update(array(
                    'nombre' => $request['nombre'],
                    'descripcion' => $request['descripcion'],
                    'tipo' => substr ($request['tipo'], 0, 1),
                    'precio' => $request['precio'],
                    'unidades' => $request['unidades'],
                    'marca' => $request['marca'],
                    'rebaja' => $request['rebaja'],
                    'imagen' => $nombre,
                    'categoria_id' => $categoria_id[0]->id,
                ));
                
                $nombreImagen = $file->getClientOriginalName(); 
                //guardamos imagen nueva
                Storage::put("productos/$nombreImagen", File::get($file));
            } else {
                //sacamos clave foranea de la categoría
                $categoria_id = Categoria::select('id')->where('nombre', '=', $request['categoria'])->where('tipo','=',$request['tipo'])->get();

                //Validación de datos enviados...
            
                //modificamos registro
                 Producto::where('id', '=', $id)->update(array(
                    'nombre' => $request['nombre'],
                    'descripcion' => $request['descripcion'],
                    'tipo' => substr ($request['tipo'], 0, 1),
                    'precio' => $request['precio'],
                    'unidades' => $request['unidades'],
                    'marca' => $request['marca'],
                    'rebaja' => $request['rebaja'],
                    'categoria_id' => $categoria_id[0]->id,
                ));
            }
            
            //mensaje de aviso
            Session::flash('messageProducto', 'Se ha modificado el producto '.$request['nombre'].'.');

            //Cogemos categorías de la base de datos ACTUALIZADAS y metemos en sesión
            $categorias = Categoria::all();
            Session::put('categorias', $categorias);
            
            //seleccionamos productos de la categoria específica
            $categoria = Categoria::all()->last();
            $productos = $categoria->productos()->paginate(8);
            //vista
//            return view('admin/categoria')->with(['categoria'=>$categoria, 'productos'=>$productos]);
             return redirect("admin/categorias/".$categoria_id[0]->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            //sacar categoria_id del producto antes de borrar
            $categoria_id = Producto::select('categoria_id')->where('id','=',$id)->get();
            
            //borramos producto
            Producto::destroy($id);
            
            //actualizamos categorias padre
            $categorias = Categoria::all();
            Session::put('categorias', $categorias);
            
            //mensaje de aviso
            Session::flash('messageProducto', 'Producto borrado. ');
            
            
            
            //seleccionamos productos de la categoria específica
            $categoria = Categoria::find($categoria_id[0]->categoria_id);
            $productos = $categoria->productos()->paginate(8);
            //vista
//            return redirect('admin/categoria')->with(['categoria'=>$categoria, 'productos'=>$productos]);
                        return redirect("admin/categorias/".$categoria_id[0]->categoria_id);

	}

}
