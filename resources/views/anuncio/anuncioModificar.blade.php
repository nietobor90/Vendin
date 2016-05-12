@extends('Layouts.principal')


@section('content')
	<div class="modal-dialog">
		<div class="modal-content">
		    <h4 class="h4Personalizado">MODIFICAR ANUNCIO</h4>
		    <div class="modal-body">
			    {!!Form::model($producto,['route'=>['anuncios.update', $producto->id], 'method'=>'PUT', 'files'=>'true'])!!}
				  <?php $imgName = "img/anuncios/".$producto->titulo.".jpg"?>
				  <?php $mensaje = Session::get('messageErrorModificar')?>
				   
			        @if($mensaje!="")
			        	<div class="alert alert-danger">
			                {{$mensaje}}
			            </div>
                    @endif
                        
				  <div id='secModAnun'> 
					  <img class="imgModifi" src="{{asset($imgName)}}" /><br>
					  <label for="imagen" class="letra-form">Imagen del anuncio</label>
				  </div>
			      <div class="form-group">  
			        <label for="imagen" class="letra-form">Cambiar imagen por:</label>
			        <input type="file" name="imagen" id="imagen" class="input-marg btn btn-file">
			        </div>
				  <div class="form-group">
				    <label for="titulo">Título</label>
				    <input type="text" class="form-control" id="titulo" name="titulo" value="{{$producto->titulo}}" 
				           placeholder="Introduce un título descriptivo">
				    <div class="text-danger"> {{$errors->first('titulo')}}</div>
				  </div>
				  <div class="form-group-lg col-md-12">
			        <label for="desc" class="letra-form">Descripción del anuncio</label>
			        <textarea name="descripcion" class="form-control input-marg" rows="3" placeholder="Describe tu anuncio..." >{{$producto->descripcion}}</textarea>
			        <div class="text-danger"> {{$errors->first('descripcion')}}</div>
			        </div>
				  <div class="form-group">
				    <label for="precio">Precio</label>
				    <input type="text" class="form-control" name="precio" id="precio" placeholder="€" value="{{$producto->precio}}">
				    <div class="text-danger"> {{$errors->first('precio')}}</div>
				  </div>
				  <div class="form-group">
			        <label for="categoria" class="letra-form">Categoría</label>
			            <select name="categoria" id="categoria" class="form-control input-marg">
			            	@if($producto->categoria == 1)
								<option value="Coches y motos" selected="selected">Coches y motos</option><option value="Consolas y videojuegos">Consolas y videojuegos</option><option value="Deporte y ocio">Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			            	@elseif($producto->categoria == 2)
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" selected="selected">Consolas y videojuegos</option><option value="Deporte y ocio">Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			                @elseif($producto->categoria == 3)
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" >Consolas y videojuegos</option><option value="Deporte y ocio" selected="selected">Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			            	@elseif($producto->categoria == 4)
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" >Consolas y videojuegos</option><option value="Deporte y ocio">Deporte y ocio</option><option value="Electrodomésticos" selected="selected">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			                @elseif($producto->categoria == 5)
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" >Consolas y videojuegos</option><option value="Deporte y ocio" >Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica" selected="selected">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			            	@elseif($producto->categoria == 6)
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" >Consolas y videojuegos</option><option value="Deporte y ocio">Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música" selected="selected">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			                @elseif($producto->categoria == 7)
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" >Consolas y videojuegos</option><option value="Deporte y ocio" >Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios" selected="selected">Moda y accesorios</option><option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			            	@elseif($producto->categoria == 8)
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" >Consolas y videojuegos</option><option value="Deporte y ocio" >Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín"selected="selected">Muebles, Deco y Jardín</option><option value="Otros">Otros</option>
			            	@else
			            		<option value="Coches y motos">Coches y motos</option><option value="Consolas y videojuegos" >Consolas y videojuegos</option><option value="Deporte y ocio" >Deporte y ocio</option><option value="Electrodomésticos">Electrodomésticos</option><option value="Electrónica">Electrónica</option><option value="Libros, Películas y Música">Libros, Películas y Música</option><option value="Moda y accesorios">Moda y accesorios</option><option value="Muebles, Deco y Jardín" >Muebles, Deco y Jardín</option><option value="Otros" selected="selected">Otros</option>
			            	@endif
			            									
			            </select>
			            <div class="text-danger"> {{$errors->first('categoria')}}</div>
			        </div>
			</div>	        
			<div class="modal-footer">        
				  <button type="submit" class="btn btn-default">Modificar</button>
				{!!Form::close()!!}
			</div>	
		</div>
	</div>
@stop