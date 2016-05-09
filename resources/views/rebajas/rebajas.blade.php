@extends('Layouts.principal')
@section('content')
<div>
   <br><br><br><br><!-- div reservado para cuando no hay opción de buscador-->
</div>
<hr class="barraResultado">
@if(isset($productos))
<!--//    MOSTRAR PRODUCTOS-->
        <!--mostramos todos los productos, incluidos los que tienen descuento-->
        <?php    
        foreach($productos as $producto):?>
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
        <?php endforeach ?>
    <div class="pagination">
        {!!$productos->render()!!}
    </div>
@else

@endif
<hr class="barraResultado">

@stop



