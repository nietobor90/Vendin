@extends('Layouts.principal')

@section('content')
	<div class="modal-dialog">
		<div class="modal-content">
			<h4 class="h4Personalizado">AYUDA Y CONTACTO</h4>
		    <div class="modal-body">
				  	<p>Si tienes alguna pregunta, necesitas ayuda o te gustaría hacer una consulta individual, por favor, ponte en contacto con nuestro servicio de atención al cliente.</p>
		            <p>Nuestra mayor prioridad es proporcionale un catálogo de anuncios de la más alta calidad.</p>
		            <h4>Opinión</h4>
		            <hr>
		            <p>Nos esforzamos constantemente para mejorar nuestra aplicación web, así que estamos abiertos a cualquier sugerencia o idea de los usuarios.</p>
		            <p>Por favor, mándanos tu opinión sobre nuestra aplicación a info@vendin.com.</p>
            
		            <br>
		            <h4>Teléfono / Fax</h4>
		            <hr>
		                <p>España:+34 913 496 546</p>
		                <p>Alemania:+49 89 41614862</p>
		                <p>Italia:+39 0294 750 776</p>
		                <p>Suiza:+41 435 082 100</p>
		                <br>
		                <p>Lu - Sá: 08.00 - 22.00</p>
		                <p>Do: 17.00 - 22.00</p>
		                <br>
		                <p>Puedes enviarnos tus preguntas también vía fax: +43 3687 2422 356</p>
		            <h4>Dirección postal</h4>
		            <hr>
		            <p>Vendin</p>
		            <p>Calle Santa María Nº 360</p>
		            <p>Talamanca de Jarama CP 28160</p>
		            <p>Madrid</p>
			</div>	        
			<div class="modal-footer">   
			  <form>    
                  <input class="btn btn-default" type="button" value="Volver atrás" name="Volver" onclick="history.back()" />
              </form>
			</div>	
		</div>
	</div>
@stop
