@extends('Layouts.principal')

      
@section('content')
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
				  <?php $imgName = "img/anuncios/".$producto->id.".jpg"?>
				  <a href="#popup" class="popup-link" onMouseOver="cambiar();" onMouseOut="volver();">
            <img id='fondo' class="imgVer" src="{{asset($imgName)}}" />
            <img id='frente' class="imgVer2" src="{{asset('img/lupa.png')}}" style='display:none;'/>
          </a>
        <!--ventana modal para mostrar imagen  -->
        <div class="modal-wrapper" id="popup">
          <div class="popup-contenedor">
             <h2>{{$producto->titulo}}</h2>
              <img class="imgTotal" src="{{asset($imgName)}}" />
             <a class="popup-cerrar" href="#">X</a>
          </div>
        </div> 

			      <label for="desc" class="precio">{{$producto->precio}}€</label><br>
				  <label for="desc" class="tituloArticle">{{$producto->titulo}}</label><br>
			      <label for="desc" class="tituloArticle3">{{$producto->descripcion}}</label><br>
          @if($producto->categoria == 1)<label for="desc" class="tituloArticle">Coches y motos</label>   
          @elseif($producto->categoria == 2)<label for="desc" class="tituloArticle">Consolas y videojuegos</label> 
          @elseif($producto->categoria == 3)<label for="desc" class="tituloArticle">Deporte y ocio</label> 
          @elseif($producto->categoria == 4)<label for="desc" class="tituloArticle">Electrodomésticos</label>  
          @elseif($producto->categoria == 5)<label for="desc" class="tituloArticle">Electrónica</label>  
          @elseif($producto->categoria == 6)<label for="desc" class="tituloArticle">Libros, Películas y Música</label> 
          @elseif($producto->categoria == 7)<label for="desc" class="tituloArticle">Moda y accesorios</label>  
          @elseif($producto->categoria == 8)<label for="desc" class="tituloArticle">Muebles, Deco y Jardin</label> 
          @else<label for="desc" class="tituloArticle">Otros</label> 
          @endif       
			</div>	        
			<div class="modal-footer">   
				
				<!-- BOTON MODIFICAR PARA USUARIOS LOGADOS -->
				@if(Auth::check())
					@if(Auth::user()->id == $producto->user)
            <button type="button" id="btnContact" class="btn btn-default" data-toggle="modal" data-target="#contactUser" disabled="true">Contacto</button>
						<a href="{{url()}}/update/{{$producto->id}}">Modificiar</a>
          @else
            <button type="button" id="btnContact" class="btn btn-default" data-toggle="modal" data-target="#contactUser">Contacto</button>
					@endif
        @else
            <button type="button" id="btnContact" class="btn btn-default" data-toggle="modal" data-target="#contactUser">Contacto</button>
				@endif	
				

			</div>	
		</div>
	</div>

@if($errors->first('nameContact') || $errors->first('emailContact') || $errors->first('mensajeContact') )
        <script type="text/javascript">
          window.onload = function(){window.document.getElementById("btnContact").click();}
        </script> 
@endif  

<!-- VENTANAS MODALES -->
	 

   <!-- ventana modal formulario de contacto -->
   <div id="contactUser" class="modal fade" role="dialog">
        <div class="modal-dialog">
         <!--  Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Enviar correo electrónico al anunciante</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" action="{{url('contact')}}">
                <!-- correo del anunciante -->
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="idAnuncio" value="{{$producto->id}}" />
                <input type="hidden" name="userAnuncio" value="{{$producto->user}}" />
                <input type="hidden" name="tituloAnuncio" value="{{$producto->titulo}}" />
                <div class="form-group">
                  <label for="name">Tu nombre</label>
                  <input type="text" required title="Introducir nombre" name="nameContact" id="nameContact" class="form-control"
                         placeholder="Introduce tu nombre">
                  <div class="text-danger"> {{$errors->first('nameContact')}}</div>
                </div>
                <div class="form-group">
                  <label for="ejemplo_email_1">Tu e-mail</label>
                  <input type="text" required title="Introducir e-mail" name="emailContact" id="emailContact" class="form-control"
                         placeholder="Introduce tu email">
                  <div class="text-danger"> {{$errors->first('emailContact')}}</div>
                </div>
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="number" name="telefonoContact" id="telefonoContact"
                  class="form-control" placeholder="(Opcional)">
                </div>
                <div class="form-group">
                  <label for="mensaje">Mensaje</label>
                  <textarea name="mensajeContact" id="mensajeContact" class="form-control input-marg" rows="3" placeholder="Mensaje para el anunciante..." ></textarea>
                  <div class="text-danger"> {{$errors->first('mensajeContact')}}</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" id="enviarCorreo" class="btn btn-default">Enviar</button>
                  
                </div>
            </form>
          </div>
        </div>   
      </div>   
    </div>   
@stop



