<?php namespace App\Http\Controllers;

use App\Producto;

class ProductosController extends Controller {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
//            return "hola desde el index dentro de el controlador de productos";
	}
        
        /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $producto = \App\Producto::find($id);
            //redirecciono a vista con producto adquirido
            return view('producto/producto')
                ->with('producto', $producto);
	}

}
