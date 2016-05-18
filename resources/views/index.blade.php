@extends('Layouts.principal')

@section('content')
    <!--mostramos todos los anuncios-->
        @foreach($anuncios as $producto)
            <article class="articleAnuncio">
                <a href="{{url()}}/view/{{$producto->id}}">
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

        <div class="pagination">
            {!!$anuncios->render()!!}
        </div>
@stop

    
    