@extends('Layouts.principal')

@section('content')
    <div class="modal-dialog">
    <div class="modal-content">
        <h4 class="h4Personalizado">PERFIL DE USUARIO</h4>
        <div class="modal-body">
            <form name="formDatos" action="{{url('usuario/perfil_user')}}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">  
                <label for="name" class="letra-form">Nombre</label>
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="{{Auth::user()->name}}" required>
                <div class="text-danger"> {{$errors->first('name')}}</div>
              </div>
              <div class="form-group">  
                <label for="apellido" class="letra-form">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido"
                       placeholder="{{Auth::user()->apellidos}}" required>
                <div class="text-danger"> {{$errors->first('apellido')}}</div>
              </div>
              <div class="form-group">  
                <label for="email" class="letra-form">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="{{Auth::user()->email}}" required>
                <div class="text-danger"> {{$errors->first('email')}}</div>
              </div>
              
        </div>          
        <div class="modal-footer">        
              <button type="submit" class="btn btn-default">ACTUALIZAR DATOS</button>
            {!!Form::close()!!} 

                <h4 class="h4Personalizado">¿Desea darse de baja?</h4>
                {!! Form::open(['route' => ['usuario.destroy', Auth::user()->id], 'method' => 'delete']) !!}
                <button onclick="pregunta()" class="btn btn-default" type='button'>DARME DE BAJA</button>
                <button  id='borrarUser' type='submit' style='display:none;'></button>
                {!!Form::close()!!}             
                            
                            
                <script language="JavaScript"> 
                function pregunta(){ 
                    if (confirm('¿Seguro que quiere darse de baja?')){ 
                       window.document.getElementById("borrarUser").click();
                    }
                } 
                </script>  
        </div>          
    </div>    
    </div>

@stop
