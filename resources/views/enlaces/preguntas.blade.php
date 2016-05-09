@extends('Layouts.principal')

@section('content')
    <section id="contenidoPreguntas">
        <article>
            
            <h2>PREGUNTAS FRECUENTES</h2>
                
            <h4>Registro</h4>
            <hr id="barraP">
            <p id="pregunta">¿Por qué registrarse con una cuenta de cliente?</p>
                <p>Siendo cliente registrado pordrá acceder a nuestra selección de artículos con descuento.</p>
                <p>Puedes cambiar tus datos personales en cualquier momento.</p>
            <br>
            <p id="pregunta">¿Como me registro?</p>
                <p>Hacerse una nueva cuenta de cliente es muy fácil y rápido:</p>
                <p>1. Haz clic en el enlace "Iniciar Sesión" en la parte superior derecha.</p>
                <p>2. Selecciona el botón de "Registrate ahora" en el lado derecho, en la zona de "Nuevo usuario".</p>
                <p>3. Introduce tu información personal y tu contraseña en el siguiente cuadro de diálogo (tu dirección de correo electrónico y tu contraseña serán tu identificación para acceder) y haz clic en «REGISTRARSE».</p>
                <p>¡Voilà! ¡Tu cuenta de cliente ya está creada y lista!</p>
            <br>
            <br>
            <h4>Facilidad de acceso</h4>
            <hr id="barraP">
            <p id="pregunta">¿Como puedo encontrar un producto concreto?</p>
                <p>La forma más rápida de encontrar un producto específico es utilizando nuestra barra de búsqueda, situada en la parte superior de la página.</p>
                <p>En ella podrá encontrar por nombre específico, el producto que sea de su interés.</p>
            <br>
            <br>
            <h4>Ayuda</h4>
            <hr id="barraP">
            <p id="pregunta">¿Como puedo ponerme en contacto con SkullBoom?</p>
            <p>Disponemos de varias formas para contactar con nosotros.</p>
            <p>Aquí encontraras toda la <a href="{{url('enlaces/contacto')}}">información de contacto</a>.</p>
	</article>
    </section>
@stop
