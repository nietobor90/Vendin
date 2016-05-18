<h1>El usuario {{$data['name']}} está interesado en tu anuncio </h1>

Datos de {{$data['name']}}:<br>
E-mail: {{$data['emailContact']}}<br>
@if($data['telefono'] != '')
    Teléfono: {{$data['telefono']}}<br>
@endif
Mensaje enviado: {{$data['mensaje']}}<br>
<br>
¡Muchas gracias por elegir Vendin!



