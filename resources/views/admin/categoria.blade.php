@extends('Layouts.admin')

@section('content')
    <section class="main">
            <div class="lista">
                    <div class="panel panel-default">
                        <!--mostramos mensaje-->
                        <?php $mensaje = Session::get('message');
                              $mensajeProducto = Session::get('messageProducto')?>
                        @if($mensaje)
                        <div class="alert alert-success">
                            {{$mensaje}}
                        </div>
                        @endif
                        @if($mensajeProducto)
                        <div class="alert alert-success">
                            {{$mensajeProducto}}
                        </div>
                        @endif
                            <div class="panel-heading">
                                    <h3 class="panel-title titulo"><b>Productos de la categoría {{$categoria->id}}, {{$categoria->nombre}} para {{$categoria->tipo}}</b></h3>
                                    <a href="{{url()}}/admin/productos/create" class="botonesAdd"><span class="glyphicon glyphicon-plus"></span></a>
                            </div>
                            <div class="panel-body">
                                <!--COMPROBAR SI HAY PRODUCTOS-->
                                @if (count($productos) === 0)<!--  SI NO HAY PRODUCTOS-->
                                    <div class="alert alert-success">
                                        No hay productos para la categoría seleccionada.
                                    </div>
                                @else <!--  SI HAY PRODUCTOS-->
                                    <table class="table table-hover">
                                        <tr class="success">
                                            <td>ID</td><td>NOMBRE</td><td>DESCRIPCIÓN</td><td>TIPO</td><td>PRECIO</td><td>UNIDADES</td><td>MARCA</td><td>REBAJA</td><td></td><td></td>
                                        </tr>
                                        @foreach($productos as $producto)
                                        <tr>
                                            <td>{{$producto->id}}</td>
                                            <td>{{$producto->nombre}}</td>
                                            <td>{{$producto->descripcion}}</td>
                                            <td>{{$producto->tipo}}</td>
                                            <td>{{$producto->precio}}€</td>
                                            <td>{{$producto->unidades}}/unid.</td>
                                            <td>{{$producto->marca}}</td>
                                            <td>{{$producto->rebaja}}%</td>
                                            <td>
                                                {!! link_to_route('admin.productos.edit', $tittle='', $parameters = $producto->id, $attributes = ['class'=>'glyphicon glyphicon-edit icon'])!!}
                                            </td>
                                            <td>
                                                {!!Form::open(['route'=>['admin.productos.destroy', $producto->id], 'method'=>'DELETE'])!!}
                                                <button type="submit"  class="bnt-sin glyphicon glyphicon-trash icon icon-list letra-marron"></button>
                                                {!!Form::close()!!}
                                            </td>
                                        <tr>
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                    </div>
            </div>
    </section>
@stop
