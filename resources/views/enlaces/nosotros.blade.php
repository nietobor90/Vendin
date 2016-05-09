@extends('Layouts.principal')

@section('content')
    <section id="contenidoNosotros">
        <article>
            
            <h2>ACERCA DE SKULLBOOM</h2>
            
            <p>SkullBoom es un escaparete virtual de ropa, creado por el alumno José María Nieto Borlaz perteneciente a la clase 2ºDAW, como proyecto final del módulo Desarrollo en Entorno Servidor del ciclo formativo de grado superior Desarrollo de Aplicaciones Web.</p>
            
            <a href="/"><img id="nosotrosLogo" src="{{ asset('img/logo.png') }}" /></a>
            
            <h4>Otros datos de interés</h4>
            <hr id="barraP">
                <p>SkullBoom ha sido creado únicamente para la visualización de productos. No se podrá realizar ningun tipo de compra.</p>
                <p>El contenido se basa principalmente en ropa de hombre y mujer.</p>
        </article>
    </section>
@stop
