@extends('Layouts.principal')

@section('content')
    <section id="contenidoLogin">
        <table>
            <tr>
                <td>
                    <h1>¿Ya tienes tu cuenta?</h1>
                    <form method="POST" action="{{url('auth/login')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <ul>
                            <li><label>Dirección de correo electrónico</label><br>
                                <input type="text" required title="Introducir correo" name="email" id="email"></li>
                            <!--<li class="danger"><div class="text-danger"> {{$errors->first('email')}}</div></li>-->
                            
                            <li><label>Contraseña</label><br>
                                <input type="password" required title="Introducir contraseña" name="password" id="password"></li>
                            <!--<li class="danger"><div class="text-danger"> {{$errors->first('password')}}</div></li>-->
                            
                            <li><button type="submit" id="enviar">LOGIN</button></li>
                        </ul>
                    </form>
                    
                </td>
                <!--linea-->
                <hr id="loginMedio"> 
                <!--linea-->
                <td id="newUser">
                    <h1>Nuevo Usuario</h1>
                    <ul>
                        <li><label>Registro rápido y sencillo</label></li>
                        <li><label>Acceso a productos con mayores descuentos</label></li>
                        <a href="register"><label id="enlaceARegistro">REGÍSTRATE AHORA</label></a> 
                    </ul>
                </td>
            </tr>
        </table>    
        
    </section>
@stop