@extends('Layouts.admin')

@section('content')
    <section class="main">
            <div class="lista">
                    <div class="panel panel-default">
                        <!--mostramos mensaje-->
                        <?php $mensaje = Session::get('messageProducto')?>
                        @if($mensaje)
                        <div class="alert alert-success">
                            {{$mensaje}}
                        </div>
                        @endif
                            <div class="panel-heading">
                                    <h3 class="panel-title titulo"><b>Modificar producto</b></h3>
                            </div>
                            <div class="panel-body">
                                {!!Form::model($producto,['route'=>['admin.productos.update', $producto->id], 'method'=>'PUT', 'files'=>'true'])!!}
                                    <div class="form-group-lg col-md-8 ">
                                            <label for="nombre" class="letra-form">Nombre</label>
                                            <input type="text" value="{{$producto->nombre}}" class="form-control input-marg" name="nombre" id="nombre" placeholder="nombre del producto">
                                    </div>
                                    <div class="form-group-lg col-md-2">
                                            <label for="precio" class="letra-form">Precio</label>
                                        <div class="input-group input-marg">
                                                    <input type="text" value="{{$producto->precio}}" class="form-control" name="precio" id="precio" placeholder="0">
                                                    <div class="input-group-addon ">€</div>
                                        </div>
                                    </div>
                                    <div class="form-group-lg col-md-2">  
                                        <label for="rebaja" class="letra-form">Rebaja</label>
                                        <div class="input-group input-marg">
                                            <input type="text" value="{{$producto->rebaja}}" class="form-control" name="rebaja" id="rebaja" placeholder="0">
                                            <div class="input-group-addon ">%</div>
                                        </div>    
                                    </div>
                                    <div class="form-group-lg col-md-2">
                                            <label for="precio" class="letra-form">Tipo</label>
                                        <select name="tipo" id="precio" class="form-control input-marg">
                                                @foreach($tipos as $tipo)
                                                    <option value="{{$tipo->tipo}}">{{$tipo->tipo}}</option>
                                                @endforeach    
                                        </select>
                                    </div>
                                    <div class="form-group-lg col-md-2">
                                            <label for="precio" class="letra-form">Unidades</label>
                                        <div class="input-group input-marg">
                                                    <input type="text" value="{{$producto->unidades}}" class="form-control" name="unidades" id="precio" placeholder="0">
                                                    
                                        </div>
                                    </div>
                                    <div class="form-group-lg col-md-2">
                                            <label for="precio" class="letra-form">Marca</label>
                                        <div class="input-group input-marg">
                                            <input type="text" value="{{$producto->marca}}" class="form-control" name="marca" id="precio">      
                                        </div>
                                    </div>
                                    <div class="form-group-lg col-md-2">  
                                        <label for="categoria" class="letra-form">Categoría</label>
                                            <select name="categoria" id="categoria" class="form-control input-marg">
                                                @foreach($categoriasPadre as $categoria)
                                                    <option value="{{$categoria->nombre}}">{{$categoria->nombre}}{{substr ($categoria->tipo, 0, 1)}}</option>
                                                @endforeach    
                                            </select>
                                    </div>
                                    <div class="form-group-lg col-md-10">  
                                        <label for="imagen" class="letra-form">Imagen del producto</label>
                                        <img id="imgCategoria" src="{{ asset($producto->imagen) }}">
                                    <input type="file" name="imagen" id="imagen" class="input-marg btn btn-file">
                                    </div>
                                    <div class="form-group-lg col-md-12">
                                            <label for="desc" class="letra-form">Descripcion</label>
                                            <textarea name="descripcion" value='{{$producto->descripcion}}' class="form-control input-marg" rows="3" placeholder="{{$producto->descripcion}}"></textarea>
                                    </div>
                                    <div class="text-right col-md-12" id="btn-producto">
                                            <input type="submit" value="Modificar" class="btn btn-primary btn-letra">
                                    </div>
                                {!!Form::close()!!}
                                <!--botón volver-->
                                <a href="{{URL::Previous()}}" class="btn btn-lg btn btn-primary">
                                    <span class="glyphicon glyphicon-share-alt"></span>
                                </a>
                            </div>
                    </div>
            </div>
    </section>
@stop
