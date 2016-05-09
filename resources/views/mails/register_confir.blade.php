<h1>Bienvenid@ a SkullBoom {{$data['name']}}</h1>

Desde el siguiente enlace podrás confirmar tu registro en nuestra página:<br>

<!--<a href="{{url()}}/auth/confirm/email/{{$data['email']}}/confirm_token/{{$data['confirm_token']}}">Confirmar cuenta de usuario</a>-->

<a href="{{url()}}/auth/confirm/id/{{$data['id']}}/confirm_token/{{$data['confirm_token']}}">Confirmar cuenta de usuario</a>
