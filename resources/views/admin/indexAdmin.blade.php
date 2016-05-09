@extends('Layouts.admin')

@section('content')
    <section class="main">
            <div class="lista">
                <!----------------------------------------MENSAJES DE AVISO----------------------------------------------------------------->
                <?php $mensaje = Session::get('messageBorradoCategoria')?>
                    @if($mensaje)
                    <div class="alert alert-warning">
                        {{$mensaje}}
                    </div>
                    @endif
            </div>
    </section>
@stop

    
    