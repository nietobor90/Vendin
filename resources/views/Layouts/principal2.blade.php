<!--//categorias-->
                <?php 
                //cogemos variables guardadas en sesión-->
                    $categoriasPadre = Session::get('categoriasP');
                    $arrayCategorias = Session::get('arrayCategorias');
                    $indice = Session::get('indice');
                    
                //espacio total para el menú css: 950px
                    $anchoMenu = 900;
                    $nSecciones = count($categoriasPadre)+2;
                    $tamanoSeccion = round($anchoMenu/$nSecciones);
                ?>
<!DOCTYPE html>
<html>
<head>
    <title>SkullBoom</title>
    <!--<link rel="stylesheet" href="{{ URL::asset('css/estilo.css') }}">-->
    
    {!! Html::style('css/estilo.css') !!}
    
    <link rel="icon" type="image/png" href="img/logo_explorador.png" />
    <!--<script language="JavaScript" src="{{ URL::asset('/js/script.js') }}"></script>-->
    {!! Html::script('js/script.js') !!}
    
    <!--ancho dinamico del menú-->
<!--    <style>.nav > li, .nav li ul {width: {{$tamanoSeccion}}px;}</style>-->
</head>
<body>
    <header>
        <table>
            <tr>
                <td><a href="/"><img id="logo" src="{{ asset('img/logo.png') }}" /></a></td>
                
                <td><h1>SkullBoom</h1></td>
                <td>
                    <form action="{{url('home/searchredirect')}}" id="searchform" name="searchform" role = "search" aria-labelledby = "alertHeading" aria-describedby = "alertText"  />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" title="botBus" name="search" id="buscar" placeholder="Buscar aqu&iacute;..." autocomplete="off" value='@yield("search")'>
                    <button type="submit"><img id="lupa" src="{{ asset('img/lupa.jpg') }}" alt="" /></button>
                </form> 
                </td>
                <td><img id="logoUser" src="{{ asset('img/usuario.png') }}" alt="" /></td>
                <!--SI EL USUARIO ESTÁ REGISTRADO...-->
                @if(Auth::check())
                <td id="iden_user">
                    <ul>
                        <li><a href="{{url()}}/usuario/{{Auth::user()->id}}">Hola, {{Auth::user()->name}}</a></li>
                        <li><a href="{{url('auth/logout')}}">Cerrar sesión</a></li>
                        @if (Auth::user()->id == 12) 
                            <li><a href="{{url('admin')}}">Administrar</a></li>
                        @endif
                    </ul>
                </td>
                @else <!--SI NO ESTÁ REGISTRADO...-->
                    <td><a href="{{url('auth/login')}}" id="iniciarSesion">Iniciar Sesión</a></td>
                @endif
            <tr>
        </table>
    </header>
    <nav>
        <div id="header">
            <ul class="nav">
                @if (isset($categoriasPadre))
                @foreach ($categoriasPadre as $categoriaPadre)
                    <!--por cada clase padre-->
                    <li><a >{{$categoriaPadre->tipo}}</a>
                            <!--indices de columnas-->
                                @foreach ($arrayCategorias as $categoria => $dato)
                                <!--por cada categoria-->
                                    @if($categoria === $indice)
                                        <ul> 
                                            @for ($i = 0; $i < count($dato); $i++)
                                                <li><a href="{{url()}}/categoria/{{$arrayCategorias[$indice][$i]->id}}">{{$arrayCategorias[$indice][$i]->nombre}}</a></li>
                                            @endfor
                                        </ul>  
                                    
                                    @endif
                                    
                                @endforeach
                                <?php $indice++;?>
                     </li>
                @endforeach
                @endif
                
                <!--VERSIÓN ANTERIOR-->
<!--                <li><a>HOMBRE</a>
                        <ul>
                                <li><a href="{{url('categoria/1')}}">Camisetas</a></li>
                                <li><a href="{{url('categoria/2')}}">Pantalones</a></li>
                                <li><a href="{{url('categoria/3')}}">Sudaderas</a></li>
                                <li><a href="{{url('categoria/4')}}">Chaquetas</a></li>
                        </ul>
                </li>
                <li><a>MUJER</a>
                        <ul>
                                <li><a href="{{url('categoria/5')}}">Camisetas</a></li>
                                <li><a href="{{url('categoria/6')}}">Vaqueros</a></li>
                                <li><a href="{{url('categoria/7')}}">Vestidos</a></li>
                                <li><a href="{{url('categoria/8')}}">Chaquetas</a></li>
                        </ul>
                </li>-->
                <li><a href="/marcas">MARCAS</a></li>
                <li><a href="/rebajas">%REBAJAS</a></li>
                
            </ul>
        </div>
        <!--linea-->
        <hr> 
        <!--linea-->
    </nav>
    
    <!----------------------------------------MENSAJES DE AVISO----------------------------------------------------------------->
        @if(Session::has('messageError'))<!--Mensaje ERROR-->     
            <div class="mensajeError">
                {{Session::get('messageError')}}
            </div>
        @elseif(Session::has('messageGood'))<!--Mensaje GOOD-->
            <div class="mensajeGood">
                {{Session::get('messageGood')}}
            </div>
        @elseif(Session::has('messageAviso')) <!--Mensaje de AVISO-->
            <div class="mensajeInformativo">
                {{Session::get('messageAviso')}}
            </div>
        @endif   
    
    <!--CONTENIDO DE LA PÁGINA-->
    @yield('content')
    
    
    <footer>
        <section id="servicios">				
                <ul id="nuestrosServ">
                        <li id="tituloPie">SERVICIO Y ASISTENCIA</li>		
                        <li><a href="{{url('enlaces/preguntas')}}">Preguntas frecuentes</a></li>
                        <li><a href="{{url('enlaces/ayuda')}}">Ayuda</a></li>
                </ul>	
                <hr id="verticalLine1">
                <ul id="pensamos">
                        <li id="tituloPie2">SKULLBOOM</li>
                        <li><a href="{{url('enlaces/nosotros')}}">Sobre nosotros</a></li>
                        <li><a href="{{url('enlaces/contacto')}}">Contacto</a></li>
                        <li><a href="{{url('mapa')}}">Ver mapa</a></li>

                </ul>
                <hr id="verticalLine2">
                <ul id="encuentranos">
                        <li id="tituloPie4">REDES SOCIALES</li>	
                        <li id="redes1">					
                                <a href="https://www.instagram.com/"><img  src="{{ asset('img/logo_istagram.jpg') }}" alt="istagram" aria-label="ImagenDeAccesoIstagram"/></a>	
                        </li>
                        <li id="redes2">					
                                <a href="https://www.facebook.com/"><img  src="{{ asset('img/logo_facebook.jpg') }}" alt="facebook" aria-label="ImagenDeAccesoFacebook"/></a>	
                        </li>
                        <li id="redes3">					
                                <a href="https://twitter.com/?lang=es"><img  src="{{ asset('img/logo_twitter.jpg') }}" alt="twitter" aria-label="ImagenDeAccesoTwitter"/></a>			
                        </li>				
                </ul>
        </section>
        <!--linea-->
        <hr id="barraAbajo"> 
        <!--linea-->   
        <h3>SkullBoom | www.skullboom.com</h3>
        <br>
        <table id="enlacesBajos">
            <tr>
                <td>
                    <ul id="terminosAdvertencia">
                        <li><a href="{{url('enlaces/politica')}}">POLÍTICA DE PROTECCIÓN DE DATOS</a></li>
                        <li><a href="{{url('enlaces/legal')}}">ADVERTENCIA LEGAL</a></li>
                    </ul>
                </td>
                <td>
                    <a href="/"><img id="logoBajo" src="{{ asset('img/logo.png') }}" alt="" /> 
                </td>
            </tr>
        </table>
    </footer>
    
    <div class="cookiesms" id="cookie1">
        Esta web utiliza cookies, puedes ver nuestra política de cookies, <a href="www.skullboom.com">aquí</a>. 
        Si continuas navegando estás aceptándola.
        <button id="acepCookie">Aceptar</button>
    </div>	
</body>
</html>


