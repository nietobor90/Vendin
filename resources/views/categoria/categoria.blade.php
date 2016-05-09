@extends('Layouts.principal')
@section('content')
<div>
   <br><br><br><br><!-- div reservado para cuando no hay opción de buscador-->
</div>
<hr class="barraResultado">
@if (isset($messageError))
    <article class="Error_busqueda">
        LO SENTIMOS<br>
        {{$messageError}}
    </article>
    <hr class="barraResultado">
@endif
<!--comprobar si hay productos-->
@if(count($productos) != 0)

@if (isset($productos))
<!--//    ORDENAR PRODUCTOS-->
    <div class="ordenar">
        <form name="formOrden" action="{{url()}}/home/ordenar/{{$productos[0]->categoria_id}}">
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
        @foreach($productos as $producto)
            <article >
                <a href="{{url()}}/producto/{{$producto->id}}">
                    <figure class="producto">
                        <!--cartel de producto rebajado-->
                        @if($producto->rebaja)
                        <figcaption class="rebajaCartel">-{{$producto->rebaja}}%</figcaption>
                        @endif
                        <img name="imagenProducto" src='{{url($producto->imagen)}}' alt="productos" aria-label="ImagenDeAccesoProducto">
                        <figcaption><p>{{$producto->nombre}}</p></figcaption>
                        <!--PRECIO-->
                        @if($producto->rebaja)
                            <label class="precioAntiguo">{{$producto->precio}}€</label>
                            <figcaption><label class="precio1">{{$producto->precio-(($producto->precio*$producto->rebaja)/100)}}€</label></figcaption>
                        @else
                            <figcaption><label class="precio1">{{$producto->precio}}€</label></figcaption>
                        @endif
                    </figure>
                </a>
            </article>
        @endforeach
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
@else
    
@endif
    <br>
@if(count($productos) > 8)    
    <div class="pagination">
        {!!$productos->render()!!}
    </div>
@endif
<hr class="barraResultado">
@endif

@stop



