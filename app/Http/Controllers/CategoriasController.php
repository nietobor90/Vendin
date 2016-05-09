<?php namespace App\Http\Controllers;
use App\Producto;

class CategoriasController extends Controller {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
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
            $productos = \App\Categoria::find($id)
                    ->productos()
                    ->paginate(8);//objeto con productos de la categoria $id
            
            
            return view('categoria/categoria')
            ->with('productos', $productos);       
	}

}
