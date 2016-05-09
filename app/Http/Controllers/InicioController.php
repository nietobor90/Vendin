<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Categoria;
use Illuminate\Support\Facades\Request;
use Session;
use Auth;

class InicioController extends Controller {
    
        
        public function __construct()
	{
            //only, solo afecta a..., except no afecta a...
                $this->middleware('auth', ['only' => ['rebajas']]);
                
                $this->middleware('admin', ['only' => ['administrador']]);
	}
        
	public function index()
	{
//            //cogemos tipos de clases que tenemos, son CATEGORÍAS PADRE
//            $categoriasPadre = Categoria::distinct()->select('tipo')->get();
//            
//            //Array para las categorias que existen
//            $arrayCategorias = [];
//            //cogemos categorias
//            foreach ($categoriasPadre as $categoriaPadre) {
//                $arrayCategorias[] = Categoria::where('tipo', '=', $categoriaPadre->tipo)->get();
//            }
//            //indice de categorias
//            $indice = 0;
//            
//            //meter variables en sesión
//            Session::put('categoriasP', $categoriasPadre);
//            Session::put('arrayCategorias', $arrayCategorias);
//            Session::put('indice', $indice);
//            
//            //seleccionamos productos de la página de inicio
//            //comprobar si el usuario está logado
//            if(Auth::check()){
//              //consulta de productos con valor pasado, estando logado
//              $productos = Producto::where('rebaja', '!=', 0)->orderBy('rebaja', 'desc')->paginate(8);
//               
//            } else {//si el user no está logado
//              $productos = \App\Producto::where('rebaja', '=', 0)->paginate(8);
//            }
            
            //redirigimos a la vista inicial con las categorias padre y las categorias de cada una
            return view('index');
            
            /////////////////////////////////////////////////////////////////////////////
            
	}
        //método para entrar en administrador
        public function administrador(){
            //MÉTODO DE INICIO DE ADMIN
            //Cogemos categorías de la base de datos
            $categorias = Categoria::all();
            Session::put('categorias', $categorias);
            //Mostramos categorías
            return view('admin/indexAdmin')
            ->with('categorias', $categorias);
        }
        //mostrar vista de marcas
        public function marcas(){
            return view('marcas');
        }
        
        //método para buscar productos desde la barra de busqueda
        public function search($search){
            $search = urldecode($search);
            
//          comprobar si el usuario está logado
            if(Auth::check()){
              //consulta de productos con valor pasado, estando logado
              $productos = Producto::where('descripcion', 'LIKE', '%'.$search.'%')->paginate(8);
               
            } else {//si el user no está logado
              $productos = Producto::where('descripcion', 'LIKE', '%'.$search.'%')->where('rebaja', '=', 0)->paginate(8);
            }
            
            //si no se han encontrado resultados
            if (count($productos) === 0) {
                //redirigimos a la siguiente vista
                return view('home/search')
                ->with('messageError', 'NO SE HAN ENCONTRADO RESULTADOS')
                        ->with('search', $search);
            } else {//si la consulta ha devuelto resultados
                return view('home/search')
                ->with('productos', $productos)
                ->with('search', $search);       
            }
        }
        
        //método para ordenar productos buscados desde el buscador de la página
        public function ordenarBusqueda(){
            //cogemos valor de busqueda y orden
            $orden = Request::input('orden');
            $search = Request::input('search');
            
            //dependiendo del tipo de orden enviado...
            switch ($orden) {
                case "Alfabetico":
                    $productos = Producto::where('descripcion', 'LIKE', '%'.$search.'%')->orderBy('nombre', 'asc')->get();
                    break;
                case "Precio descendente":
                    $productos = Producto::where('descripcion', 'LIKE', '%'.$search.'%')->orderBy('precio', 'desc')->get();
                    break;
                case "Precio ascendente":
                    $productos = Producto::where('descripcion', 'LIKE', '%'.$search.'%')->orderBy('precio', 'asc')->get();
                    break;
            }
            
            //redirigimos a la vista de busqueda
            return view('home/search')
                ->with('productos', $productos)
                ->with('search', $search);
        }
        
        public function ordenarCategoria($id){
            $orden = Request::input('orden');
            
            //dependiendo del tipo de orden enviado...
            switch ($orden) {
                case "Alfabetico":
                    $productos = \App\Categoria::find($id)->productos()->orderBy('nombre', 'asc')->get();
                    break;
                case "Precio descendente":
                    $productos = \App\Categoria::find($id)->productos()->orderBy('precio', 'desc')->get();
                    break;
                case "Precio ascendente":
                    $productos = \App\Categoria::find($id)->productos()->orderBy('precio', 'asc')->get();
                    break;
            }
            
            //redirigimos a la vista de busqueda
            return view('categoria/categoria')
                ->with('productos', $productos);
        }
        
        //método visualizar solo los productos rebajados del escaparate, solo tienen acceso los usuarios registrados
        public function rebajas(){
//            cogemos productos que tienen rebaja
            $productos = Producto::where('rebaja', '!=', 0)->orderBy('nombre', 'asc')->paginate(8);
//            utilizamos la misma vista de categoria para mostras los productos
            return view('rebajas/rebajas')
                ->with('productos', $productos);
            
        }
        
        //ENLACES PIE DE PÁGINA
        //enlace preguntas frecuentes
        public function preguntas(){
            return view('enlaces/preguntas');
        }
        //enlace Ayuda
        public function ayuda(){
            return view('enlaces/ayuda');
        }
        //enlace Sobre Nosotros
        public function nosotros(){
            return view('enlaces/nosotros');
        }
        //enlace contacto
        public function contacto(){
            return view('enlaces/contacto');
        }
        //enlace Legal
        public function legal(){
            return view('enlaces/legal');
        }
        //enlace Política y protección de datos
        public function politica(){
            return view('enlaces/politica');
        }
}
