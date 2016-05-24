<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Categoria;
use App\anuncio;
use Illuminate\Support\Facades\Request;
use Session;
use Auth;
use Cookie;

class InicioController extends Controller {
    
        
        public function __construct()
	{
        // $this->middleware('admin', ['only' => ['administrador']]);
	}
        
	public function index()
	{
            //COOKIE FORZADA PARA PRUEBA
             Cookie::queue(Cookie::make('vendin', 'VENDIN', 45000));

            //seleccionamos todos los anuncios de la base de datos ordenados por fecha de ultima publicación 
            $anuncios = Anuncio::AnuncioOK()->orderBy('created_at', 'desc')->paginate(8);
            
            //redirigimos a la vista inicial con los anuncios
            return view('index')
            ->with('anuncios', $anuncios);
            
	}
    
    //método para buscar anuncio desde la barra de busqueda
    public function search($search , $categoria){

        //COMPROBAR SI SE HA FILTRADO POR CATEGORÍA
        if($categoria == 0){//busqueda realizada en Todas las categorías
            $search = urldecode($search);
            //coger anuncios filtrando por descripción o por título
            $productos = Anuncio::where('descripcion', 'LIKE', '%'.$search.'%')->orWhere('titulo', 'LIKE', '%'.$search.'%')->paginate(8);
            
            //si no se han encontrado resultados
            if (count($productos) === 0) {
                //redirigimos a la siguiente vista
                return redirect('/')
                ->with('messageError', 'No se han encontrado resultados para la búsqueda: '.$search);
            } else {//si la consulta ha devuelto resultados
                return view('home/search')
                ->with('productos', $productos)
                ->with('search', $search);       
            }
        } else {
            $search = urldecode($search);
            //coger anuncios filtrando por descripción o por título
            $productosDes = Anuncio::where('descripcion', 'LIKE', '%'.$search.'%')
            ->Where('categoria', $categoria)
            ->paginate(8);
            $productosTit = Anuncio::where('titulo', 'LIKE', '%'.$search.'%')
            ->Where('categoria', $categoria)
            ->paginate(8);
            //si no se han encontrado resultados
            if (count($productosDes) == 0 && count($productosTit) == 0) {
                //redirigimos a la siguiente vista
                return redirect('/')
                ->with('messageError', 'No se han encontrado resultados para la búsqueda: '.$search);
            } else {//si la consulta ha devuelto resultados
                if(count($productosDes) != 0){
                    return view('home/search')->with('productos', $productosDes)->with('search', $search);
                } else {
                    return view('home/search')->with('productos', $productosTit)->with('search', $search);    
                }
                       
            }
        }
    }
        
    public function publicarAnuncio(){
        return view('anuncio/publicar');
    }
    public function modificarAnuncio(){
        //Cogemos los anuncios que tiene el usuario conectado
        if(Auth::check()){
         //consulta de anuncios del usuario ordenados por fecha de creación
         $anuncios = Anuncio::where('user', '=', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(8);
       }
        return view('anuncio/modificar')
        ->with('anuncios', $anuncios);
    }

    // ENLACES         
    public function cookies(){
        return view('enlaces/cookies');
    }
    public function ayuda(){
        return view('enlaces/ayuda');
    }
    public function politica(){
        return view('enlaces/politica');
    }
    public function condiciones(){
        return view('enlaces/condiciones');
    }
}
