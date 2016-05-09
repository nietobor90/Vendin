<!--//categorias-->
                <?php 
                //cogemos variables guardadas en sesión-->
//                    $categoriasPadre = Session::get('categoriasP');
//                    $arrayCategorias = Session::get('arrayCategorias');
//                    $indice = Session::get('indice');
                    
                //espacio total para el menú css: 950px
//                    $anchoMenu = 900;
//                    $nSecciones = count($categoriasPadre)+2;
//                    $tamanoSeccion = round($anchoMenu/$nSecciones);
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
                                              <select class="form-control" id="categoria">
                                                <option>Coches y motos</option>
                                                <option>Consolas y videojuegos</option>
                                                <option>Deporte y ocio</option>
                                                <option>Electrodomesticos</option>
                                                <option>Electrónica</option>
                                                <option>Libros, Películas y Música</option>
                                                <option>Moda y accesorios</option>
                                                <option>Muebles, Deco y Jardin</option>
                                                <option>Otros</option>
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
<!--                                  BOTON DE LOGIN-->
                              </div>
                            </div>
                        </div>
                    </td>
                <!--SI EL USUARIO ESTÁ REGISTRADO...-->
                @if(Auth::check())
                <td id="seccionLogin">
                    <ul>
                        <li><a href="{{url()}}/usuario/{{Auth::user()->id}}">Hola, {{Auth::user()->name}}</a></li>
                        <li><a href="{{url('auth/logout')}}">Cerrar sesión</a></li>
                        @if (Auth::user()->id == 12) 
                            <li><a href="{{url('admin')}}">Administrar</a></li>
                        @endif
                    </ul>
                </td>
                @else <!--SI NO ESTÁ REGISTRADO...-->
                    <td id="seccionLogin">
                    <div id="bar">
                        <div id="container">
                            <!-- Login Starts Here -->
                            <div id="loginContainer">
                                <a href="#" id="loginButton"><span>Login</span><em></em></a>
                                <div style="clear:both"></div>
                                <div id="loginBox">                
                                    <form id="loginForm">
                                        <fieldset id="body">
                                            <fieldset>
                                                <label for="email">Email Address</label>
                                                <input type="text" name="email" id="email" />
                                            </fieldset>
                                            <fieldset>
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" />
                                            </fieldset>
                                            <input type="submit" id="login" value="Sign in" />
                                            <label for="checkbox"><input type="checkbox" id="checkbox" />Remember me</label>
                                        </fieldset>
                                        <span><a href="#">Forgot your password?</a></span>
                                    </form>
                                </div>
                            </div>
                            <!-- Login Ends Here -->
                        </div>
                    </div>
                    </td><!-- <a href="{{url('auth/login')}}" id="iniciarSesion">Iniciar Sesión</a> -->
                @endif
            <tr>
        </table>
    </header>
    
    <!--CONTENIDO DE LA PÁGINA-->
    @yield('content')
</body>
</html>


