@extends('Layouts.principal')
@section('search', $search)
@section('content')
<!--mensaje informativo con valor de busqueda-->
@if ($search != "")
    <div>
        <p><h2>Resultados de la busqueda: {{$search}}</h2></p>
    </div>
@else
    <div>
        <br><br><br><br><!-- div reservado para cuando no hay opción de buscador-->
    </div>
@endif
<hr class="barraResultado">

<!--si no hay resultados-->
@if (isset($messageError))
    <article class="Error_busqueda">
        <label>LO SENTIMOS</label><br>
        <label>{{$messageError}}</label>
    </article>
    <video src="{{url('videos/404_error.mp4')}}" class="video" width="500" autoplay loop controls></video>
    <br>
@endif

<!--si hay productos, creamos formulario para poder ordenarlos-->
@if (isset($productos))
<!--//    ORDENAR PRODUCTOS-->
    <div class="ordenar">
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
    </div>
    
<!--//    MOSTRAR PRODUCTOS-->
<!--Comprobar si el usuario esta conectado-->
    @if(Auth::check())
        <!--mostramos todos los productos, incluidos los que tienen descuento-->
        <?php    
        foreach($productos as $producto):?>
            <article >
                <a href="{{url()}}/producto/{{$producto->id}}">
                    <figure class="producto">
                        <!--cartel de producto rebajado-->
                        <?php  if($producto->rebaja){ ?>
                        <figcaption class="rebajaCartel">-{{$producto->rebaja}}%</figcaption>
                        <?php }?>
                        <img name="imagenProducto" src='{{url($producto->imagen)}}' alt="productos" aria-label="ImagenDeAccesoProducto">
                        <figcaption><p>{{$producto->nombre}}</p></figcaption>
                        <figcaption><label class="precio1">{{$producto->precio}}€</label></figcaption>
                    </figure>
                </a>
            </article>
        <?php endforeach ?>
    @else <!--SI NO ESTÁ CONECTADO...-->
        <?php  
        //Mostramos solo los productos que no tienen descuento aplicado
        foreach($productos as $producto):
            if(!$producto->rebaja){ ?>
                <article >
                    <a href="{{url()}}/producto/{{$producto->id}}">
                        <figure class="producto">
                            <img name="imagenProducto" src='{{url($producto->imagen)}}' alt="productos" aria-label="ImagenDeAccesoProducto">
                            <figcaption><p>{{$producto->nombre}}</p></figcaption>
                            <figcaption><label class="precio1">{{$producto->precio}}€</label></figcaption>
                        </figure>
                    </a>
                </article>
            
        <?php } 
        endforeach ?>
    @endif


@endif
<br>
<div class="pagination">
    {!!$productos->render()!!}
</div>
<hr class="barraResultado">
@stop

