@extends('Layouts.principal')

@section('content')
    <section id="contenidoUpdate">
        <form name="formDatos" action="{{url('usuario/perfil_user')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="text_info_update">
            @if(Session::has('message'))
                {{Session::get('message')}}
            @endif
            </div>
            <table>
                <h2 id="datosPerUpdate">Datos personales</h2>
                <hr id="lineaUpdate1">
                    <tr>
                        <td>
                            <img id="logoUpdate" src="{{ asset('img/usuario.png') }}" alt="" />
                        </td>
                        <td id="formUser">
                            <label>Nombre *</label><br>
                            <input type="text" required title="Introducir nombre" value="<?php echo Auth::user()->name;?>" name="name" id="name"><br>
                            <div class="text-danger"> {{$errors->first('name')}}</div>
                            <label>Apellido(s) *</label><br>
                            <input type="text" required title="Introducir apellidos" value="<?php echo Auth::user()->apellidos;?>" name="apellidos" id="apellidos"><br>
                            <div class="text-danger"> {{$errors->first('apellidos')}}</div>
                            <label>Correo electrónico *</label><br>
                            <input type="text" required title="Introducir e-mail" value="<?php echo Auth::user()->email;?>" name="email" id="email">
                            <div class="text-danger"> {{$errors->first('email')}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button type="submit" id="actualizarDatos">ACTUALIZAR</button>
                        </td>
                    </tr>
            </table>
        </form>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table id="tableBaja">
                <h2 id="cambiarPassUpdate">¿Desea darse de baja?</h2>
                <hr id="lineaUpdate2">
                    <tr>
                        <td>
                            {!! Form::open(['route' => ['usuario.destroy', Auth::user()->id], 'method' => 'delete']) !!}
                                <button id="botonBaja" type="submit">DARME DE BAJA</button>
                            {!! Form::close() !!} 
                        </td>
                        <td>
                            <a href="/home"><label id="cancelar">SALIR</label></a>
                        </td>
                    </tr>
            </table>
        
    </section>

@stop
