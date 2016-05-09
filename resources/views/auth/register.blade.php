@extends('Layouts.principal')

@section('content')
    <section id="contenidoRegistro">
        <h1>Registro</h1>
        <hr id="registroBarra"> <!--linea-->
        
        <div class="text_info">
            @if(Session::has('message'))
                {{Session::get('message')}}
            @endif
        </div>
        
        <!--{!!Form::open(['url'=>'auth/register', 'method'=>'POST'])!!}-->
        <form method="POST" action="{{url('auth/register')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table>
                <ul>
                    <tr>
                        <td>
                            <li><label>Nombre *</label><br><input type="text" required title="Introducir nombre" name="name" id="name"></li>
                               
                        </td>
                        <td>
                            <li><label>Apellidos *</label><br><input type="text" required title="Introducir apellidos" name="apellidos" id="apellidos"></li>
                            
                        </td>    
                    </tr>
                    <tr>
                        <td class="danger">
                            <div class="text-danger"> {{$errors->first('name')}}</div>
                        </td>
                        <td class="danger">
                            <div class="text-danger"> {{$errors->first('apellidos')}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li><label>Dirección de correo electrónico *</label><br><input type="text" required title="Introducir e-mail"name="email" id="email"></li>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="danger">
                            <div class="text-danger"> {{$errors->first('email')}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li><label>Contraseña *</label><br><input type="password" required title="Introducir contraseña" name="password" id="password"></li>
                            
                        </td>
                        <td>
                            <li><label>Repetir contraseña *</label><br><input type="password" required title="Repetir contraseña" name="password_confirmation" id="password_confirmation"></li>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="danger">
                            <div class="text-danger"> {{$errors->first('password')}}</div>
                        </td>
                        <td class="danger">
                            <div class="text-danger"> </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>
                                <input type="checkbox" required title="Debe aceptar los terminos y condiciones" name="php" id="condiciones">
                                <a href="terminos.php">
                                    <label>
                                        Acepto los términos y condiciones
                                    </label>
                                </a> 
                            </li>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" id="enviar">REGISTRARSE</button>
                        </td>                                
                    </tr>
                    <tr>
                        <td>
                            <p>* Campo obligatorio</p><br>
                        </td>                                
                    </tr>
                </ul>
            </table>
        </form>
        <!--{!!Form:: close()!!}-->
            
    </section>
@stop