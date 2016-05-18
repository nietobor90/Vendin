@extends('Layouts.principal')

@section('content')
<!--mensaje informativo con valor de busqueda-->
@if ($search != "")
    <div>
        <p><h2>Resultados de la busqueda: {{$search}}</h2></p>
    </div>
@endif

<!--si hay productos, creamos formulario para poder ordenarlos-->
<!-- @if (isset($productos)) -->
<!--//    ORDENAR PRODUCTOS-->
    <!-- <div class="ordenar">
        <form name="formOrden" action="{{url('home/ordenar/search')}}">
            <input type="hidden" name="search" value="{{ $search }}">
                <div class="selectMenuOrden">
                    <label>Ordenar:</label>
                    <select name='orden' onchange="enviarOrden()" class="selectChange">
                        <option></option>
                        <option>Alfabetico</option>
                        <option>Precio descendente</option>
                        <option>Precio ascendente</option>
                    </select>
                </div>
        </form>
    </div> -->
    
<!--//    MOSTRAR PRODUCTOS-->
    <!--mostramos todos los anuncios-->
        @foreach($productos as $producto)
            <article class="articleAnuncio">
                <a href="{{url()}}/view/{{$producto->id}}">
                    <figure >
                    <?php $imgName = "img/anuncios/".$producto->id.".jpg"?>
                        <img name="imagenProducto" src='{{asset($imgName)}}' alt="productos" aria-label="ImagenDeAccesoProducto">
                        <!--PRECIO-->
                        <figcaption class="precio"><label >{{$producto->precio}} €</label></figcaption>
                        <figcaption class="tituloArticle"><label >{{$producto->titulo}}</label ></figcaption><br>
                    </figure>
                </a>
            </article>
        @endforeach

@endif
<br>
<div class="pagination">
    {!!$productos->render()!!}
</div>
<hr class="barraResultado">
@stop

