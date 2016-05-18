@extends('Layouts.principal')

@section('content')
	<!--Comprobar si el usuario esta conectado-->
    @if(Auth::check())
        <!--mostramos todos los productos, incluidos los que tienen descuento-->
        @foreach($anuncios as $producto)
            <article class="articleAnuncio">
                <a href="{{url()}}/update/{{$producto->id}}">
                    <figure >
                    <?php $imgName = "img/anuncios/".$producto->id.".jpg"?>
                        <img name="imagenProducto" src='{{$imgName}}' alt="productos" aria-label="ImagenDeAccesoProducto">
                        <!--PRECIO-->
                        <figcaption class="precio"><label >{{$producto->precio}} €</label></figcaption>
                        <figcaption class="tituloArticle"><label >{{$producto->titulo}}</label ></figcaption><br>
                    </figure>
                </a>
            </article>
        @endforeach
    @endif
@stop

