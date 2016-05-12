<h1>Bienvenid@ a Vendin {{$data['name']}}</h1>

Para que podamos completar su registro en la aplicación usted debe confirmarnos su registro desde el siguiente enlace:<br>

<!--<a href="{{url()}}/auth/confirm/email/{{$data['email']}}/confirm_token/{{$data['confirm_token']}}">Confirmar cuenta de usuario</a>-->

<a href="{{url()}}/auth/confirm/id/{{$data['id']}}/confirm_token/{{$data['confirm_token']}}">Confirmar cuenta de usuario</a><br>

Muchas gracias por elegir Vendin.
