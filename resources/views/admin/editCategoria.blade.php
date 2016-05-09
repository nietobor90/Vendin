@extends('Layouts.admin')

@section('content')
    <section class="main">
            <div class="lista">
                    <div class="panel panel-default">
                        <!--mostramos mensaje-->
                        <?php $mensaje = Session::get('message')?>
                        @if($mensaje)
                        <div class="alert alert-success">
                            {{$mensaje}}
                        </div>
                        @endif
                            <div class="panel-heading">
                                    <h3 class="panel-title titulo"><b>Modificar categoría {{$categoria->id}}</b></h3>
                            </div>
                            <div class="panel-body">
                            {!!Form::model($categoria,['route'=>['admin.categorias.update', $categoria->id], 'method'=>'PUT', 'files'=>'true'])!!}
                                
                                    <div class="form-group-lg col-md-4">
                                            <label for="nombre" class="letra-form">Nombre Categoría Padre</label>
                                            <input type="text" class="form-control input-marg" name="categoria" id="categoria" value="{{$categoria->tipo}}">
                                    </div>
                                    <div class="form-group-lg col-md-4">
                                            <label for="nombre" class="letra-form">Nombre Subcategoría</label>
                                            <input type="text" class="form-control input-marg" name="subcategoria" id="subcategoria" value="{{$categoria->nombre}}">
                                    </div>
                                    <div class="form-group-lg col-md-4">
                                            <label for="nombre" class="letra-form">Descripción</label>
                                            <textarea class="form-control" rows="3" name="descripcion" id="descripcion">{{$categoria->descripcion}}</textarea>
                                    </div>
                                    <div class="form-group-lg col-md-6">  
                                        <label for="imagen" class="letra-form">Imagen de la categoría</label>
                                        <br>
                                        <img id="imgCategoria" src="{{url()}}/img/categorias/{{$categoria->imagen}}">
                                    <input type="file" name="imagen" id="imagen" class="input-marg btn btn-file">
                                    </div>
                                    <div class="col-md-2 text-left" id="btn-categoria">
                                            <input type="submit" value="Modificar" class="btn btn-primary btn-letra">
                                    </div>
                            {!!Form::close()!!}
                            </div>
                    </div>
            </div>
    </section>
@stop
