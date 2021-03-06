<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Vendin</title>
    <link rel="icon" href="img/logo.jpg" />
    {!! Html::script('js/script.js') !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::script('js/jquery.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::style('css/style.css') !!}
    {!! Html::script('js/login.js') !!}
</head>
<body>
    <div id="contenedor">
      <header>
          <table>
                  <tr>
                      <td><a href="/"><img id="logo" src="{{ asset('img/logo.jpg') }}" /></a></td>

                      <td id="seccionBuscador"><h1>Vendin</h1>
                          <h4>Vende lo que no usas, compra lo que necesitas...</h4>
                          <div class="row">
                              <div class="col-lg-6">
                                <div class="input-group">
                                  <form action="{{url('home/searchredirect')}}" id="searchform" name="searchform" role = "search" aria-labelledby = "alertHeading" aria-describedby = "alertText"  />
                                      <table>
                                          <tr>
                                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                              <td>  
                                                <input type="text" title="botBus" name="search" id="buscar" placeholder="Buscar aqu&iacute;..." autocomplete="off" value='@yield("search")'>
                                              </td>
                                              <td>  
                                                <select class="form-control" name="categoria" id="categoria">
                                                  <option value="0">Todas las categorías</option>
                                                  <option value="1">Coches y motos</option>
                                                  <option value="2">Consolas y videojuegos</option>
                                                  <option value="3">Deporte y ocio</option>
                                                  <option value="4">Electrodomésticos</option>
                                                  <option value="5">Electrónica</option>
                                                  <option value="6">Libros, Películas y Música</option>
                                                  <option value="7">Moda y accesorios</option>
                                                  <option value="8">Muebles, Deco y Jardin</option>
                                                  <option value="9">Otros</option>
                                                </select>
                                              </td>
                                              <td>
                                                <span class="input-group-btn">
                  <!--                              <button class="btn btn-default" type="button">Buscar</button>-->
                                                      <button class="btn btn-default" type="submit">Buscar</button>
                                                </span>
                                              </td>
                                          </tr>
                                      </table>
                                  </form>



                                </div>
                              </div>
                          </div>
                      </td>
                  <!--SI EL USUARIO ESTÁ REGISTRADO...-->
                  @if(Auth::check())
                  <td id="seccionLogin">
                      <ul>
                          <li><a href="{{url()}}/usuario/{{Auth::user()->id}}"><img class="logosUser" src="{{asset('img/logoUser.jpg') }}"/>Hola, {{Auth::user()->name}}</a>
                          <a href="{{url('auth/logout')}}"><img class="logosUser" src="{{ asset('img/logoLogout.jpg') }}" /></a></li>
                          
                      </ul>
                  </td>
                  @else <!--SI NO ESTÁ REGISTRADO...-->
                      <td id="seccionLogin">
                      <div id="bar">
                          <div id="container">
                              <!-- Login Starts Here -->
                              <div id="loginContainer">
                                  <a href="#" id="loginButton"><span>Entrar</span><em></em></a>
                                  <div style="clear:both"></div>
                                  <div id="loginBox">                
                                      <form method="POST" action="{{url('auth/login')}}" id="loginForm">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <fieldset id="body">

                                              <fieldset>
                                                  <label for="email">Email</label>
                                                  <input type="text" required title="Introducir correo" name="emailLogin" id="emailLogin"/>
                                                  
                                                  <div class="text-danger"> {{$errors->first('emailLogin')}}</div>
                                                  
                                              </fieldset>
                                              <fieldset>
                                                  <label for="password">Contraseña</label>
                                                  <input type="password" required title="Introducir contraseña" name="passwordLogin" id="passwordLogin"/>
                                                  <div class="text-danger"> {{$errors->first('passwordLogin')}}</div>
                                              </fieldset>
                                              <input type="submit" id="enviar"  value="Acceder" />
                                              <input type="button" id="btnRegis"  value="Registro" data-toggle="modal" data-target="#registroUser"/>
                                              <!-- <label for="checkbox"><input type="checkbox" id="checkbox" />Remember me</label> -->
                                          </fieldset>
                                          <!-- <span><a href="#">Forgot your password?</a></span> -->
                                      </form>


                                  </div>
                              </div>
                              
                          </div>
                      </div>
                      </td>
                  @endif
              <tr>
          </table>
      </header>

      

      <!-- CARGAR PANELES PARA MENSAJES DE ERROR OPORTUNOS -->
      @if($errors->first('name') || $errors->first('apellidos') || $errors->first('email') || $errors->first('password')) --><!-- Mensaje ERROR   -->   
        <script type="text/javascript">
          window.onload = function(){window.document.getElementById("btnRegis").click();}
        </script> 
      @elseif($errors->first('emailLogin') || $errors->first('passwordLogin') )
        <script type="text/javascript">
          window.onload = function(){window.document.getElementById("loginBox").style.display = 'block'}
        </script> 
      @endif    
      @if(Auth::check())
        <nav class="navbar navbar-default" role="navigation">
          <!-- El logotipo y el icono que despliega el menú se agrupan
               para mostrarlos mejor en los dispositivos móviles -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
              <span class="sr-only">Desplegar navegación</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
         
          <!-- Agrupar los enlaces de navegación, los formularios y cualquier
               otro elemento que se pueda ocultar al minimizar la barra -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li><a href="{{url('/')}}"> <img class="logoMenu1" src="{{ asset('img/logoInicio.jpg') }}" /></a></li>
              <li><a href="{{url('publicar')}}"><img class="logoMenu" src="{{ asset('img/logoPublicar.jpg') }}" />PUBLICAR ANUNCIO</a></li>
              <li><a href="{{url('modificar')}}"><img class="logoMenu" src="{{ asset('img/logoModificar.jpg') }}" />MODIFICAR MIS ANUNCIOS</a></li>
            </ul>
          </div>
        </nav>
      @endif
      <!---MENSAJES DE AVISO-->
          @if(Session::has('messageError'))<!--Mensaje ERROR-->     
              <div class="alert alert-danger">
                  {{Session::get('messageError')}}
              </div>
          @elseif(Session::has('messageGood'))<!--Mensaje GOOD-->
              <div class="alert alert-success">
                  {{Session::get('messageGood')}}
              </div>
          @elseif(Session::has('messageAviso')) <!--Mensaje de AVISO-->
              <div class="alert alert-warning">
                  {{Session::get('messageAviso')}}
              </div>
          @endif
      <!--CONTENIDO DE LA PÁGINA-->
      @yield('content')


       <!-- VENTANAS MODALES -->
      <div id="registroUser" class="modal fade" role="dialog">
        <div class="modal-dialog">

         <!--  Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Registro de usuario</h4>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" action="{{url('auth/register')}}"><!-- {{url('auth/register')}}-->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" required title="Introducir nombre" name="name" id="name" class="form-control"
                         placeholder="Introduce tu nombre">
                  <div class="text-danger"> {{$errors->first('name')}}</div>
                </div>
                <div class="form-group">
                  <label for="name">Apellido</label>
                  <input type="text" required title="Introducir apellido" name="apellidos" id="apellido" class="form-control"
                         placeholder="Introduce tu primer apellido">
                  <div class="text-danger"> {{$errors->first('apellidos')}}</div>
                </div>
                <div class="form-group">
                  <label for="ejemplo_email_1">Correo Electrónico</label>
                  <input type="text" required title="Introducir e-mail" name="email" id="email" class="form-control"
                         placeholder="Introduce tu email">
                  <div class="text-danger"> {{$errors->first('email')}}</div>
                </div>
                <div class="form-group">
                  <label for="ejemplo_password_1">Contraseña</label>
                  <input type="password" required title="Introducir contraseña" name="password" id="password"
                  class="form-control" placeholder="Contraseña">
                  <div class="text-danger"> {{$errors->first('password')}}</div>
                </div>
                <div class="form-group">
                  <label for="ejemplo_password_2">Repetir Contraseña</label>
                  <input type="password" required title="Repetir contraseña" name="password_confirmation" id="password_confirmation" class="form-control" 
                         placeholder="Verificar contraseña">
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="submit" id="enviar" class="btn btn-default">Registrar</button>
              </form>
            </div>
          </div>

        </div>
      </div>
  </div>    
</body>
<hr>
<footer>

  <table id="enlacesPie">
    <tr>
      <td>
        <a href="{{url('/condiciones')}}">Condiciones de uso</a>
      </td>
      <td> | </td>
      <td>
        <a href="{{url('/ayuda')}}">Ayuda</a>
      </td>
      <td> | </td>
      <td>
        <a href="{{url('/politica')}}">Política de privacidad</a>
      </td>
    </tr>
  </table>
</footer>
<hr>
  <div class="copyright">&#169; 2016 Vendin</div>
  <img class="imgPie" src="{{ asset('img/fondoPie.jpg') }}" />
<!-- COOKIES -->
@if(!isset($_SESSION['cookies']))
  <?php $_SESSION['cookies'] = 'cookies';?>
  <div class="cookiesms" id="cookie1">
  Esta web utiliza cookies, puedes ver nuestra  <a href="{{url('/cookies')}}">la política de cookies, aquí</a> 
  Si continuas navegando estás aceptándola
  <button onclick="controlcookies()">Aceptar</button>
  <div  class="cookies2" onmouseover="document.getElementById('cookie1').style.bottom = '0px';">Política de cookies + </div>
  </div>
  $_SESSION['cookies'] = 'cookies';
@endif  
<script type="text/javascript">
  if (localStorage.controlcookie>0){
   document.getElementById('cookie1').style.bottom = '-50px';
  }
</script>

</html>


