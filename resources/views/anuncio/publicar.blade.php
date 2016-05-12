@extends('Layouts.principal')

@section('content')
<div class="modal-dialog">
	<div class="modal-content">
	    <h4 class="h4Personalizado">PUBLICAR ANUNCIO</h4>
	    <div class="modal-body">
		    {!!Form::open(['route'=>'anuncios.store', 'method'=>'POST', 'files'=>'true'])!!}
		      <input type="hidden" name="idUser" value="{{Auth::user()->id}}">
		      <div class="form-group">  
		        <label for="imagen" class="letra-form">Imagen del anuncio</label>
		        <input type="file" name="imagen" id="imagen" class="input-marg btn btn-file">
		        <div class="text-danger"> {{$errors->first('imagen')}}</div>
		        </div>
			  <div class="form-group">
			    <label for="titulo">Título</label>
			    <input type="text" class="form-control" id="titulo" name="titulo"
			           placeholder="Introduce un título descriptivo">
			    <div class="text-danger"> {{$errors->first('titulo')}}</div>
			  </div>
			  <div class="form-group-lg col-md-12">
		        <label for="desc" class="letra-form">Descripción del anuncio</label>
		        <textarea name="descripcion" class="form-control input-marg" rows="3" placeholder="Describe tu anuncio..."></textarea>
		        <div class="text-danger"> {{$errors->first('descripcion')}}</div>
		        </div>
			  <div class="form-group">
			    <label for="precio">Precio</label>
			    <input type="text" class="form-control" name="precio" id="precio" placeholder="€">
			    <div class="text-danger"> {{$errors->first('precio')}}</div>
			  </div>
			  <div class="form-group">
		        <label for="categoria" class="letra-form">Categoría</label>
		            <select name="categoria" id="categoria" class="form-control input-marg">
														<option value="Coches y motos">Coches y motos</option>
		                                                <option value="Consolas y videojuegos">Consolas y videojuegos</option>
		                                                <option value="Deporte y ocio">Deporte y ocio</option>
		                                                <option value="Electrodomésticos">Electrodomésticos</option>
		                                                <option value="Electrónica">Electrónica</option>
		                                                <option value="Libros, Películas y Música">Libros, Películas y Música</option>
		                                                <option value="Moda y accesorios">Moda y accesorios</option>
		                                                <option value="Muebles, Deco y Jardín">Muebles, Deco y Jardín</option>
		                                                <option value="Otros">Otros</option>
		            </select>
		            <div class="text-danger"> {{$errors->first('categoria')}}</div>
		        </div>
		</div>	        
		<div class="modal-footer">        
			  <button type="submit" class="btn btn-default">Publicar</button>
			{!!Form::close()!!}
		</div>	
	</div>
</div>
@stop

