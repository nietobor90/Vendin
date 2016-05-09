@extends('Layouts.principal')
@section('content')

<section id="contenidoProducto">
    <table>
        <tr>
            <td>
                <img name="imagenProducto" src='{{url($producto->imagen)}}'>
            </td>
            <td >
                <div class="descriProduct">
                    <?php  if($producto->rebaja){ ?>
                        <figcaption class="rebajaCartelGrande">-{{$producto->rebaja}}%</figcaption>
                    <?php }?>
                    <img class="imagenMarca" src='{{url()}}/img/marcas/{{$producto->marca}}.png'>
                    <p>{{$producto->nombre}}</p>
                    <br><hr class="barrasProductos"><br>
                    <p><!--PRECIO-->
                        @if($producto->rebaja)
                            <label class="precioAntiguoProducto">antes {{$producto->precio}}€</label>
                            <figcaption><label class="precio1Producto">{{$producto->precio-(($producto->precio*$producto->rebaja)/100)}}€</label></figcaption>
                        @else
                            <figcaption><label class="precio1Producto">{{$producto->precio}}€</label></figcaption>
                        @endif
                    </p>
                    <br><hr class="barrasProductos"><br>
                    <p>{{$producto->descripcion}}</p>
                    <br><hr class="barrasProductos"><br>
                    @if ($producto->tipo === "H")
                        <p>Corte: El modelo mide 188 cm y lleva una talla M.</p>
                    @else
                        <p>Corte: La modelo mide 170 cm y lleva una talla M.</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>
</section>
@stop

