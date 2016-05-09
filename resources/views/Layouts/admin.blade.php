<?php 
    //cogemos variables guardadas en sesión-->
    $categorias = Session::get('categorias');
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!--<link rel="stylesheet"  media="screen" type="text/css" href="css/bootstrap.min.css">-->
        {!! Html::style('css/bootstrap.min.css') !!}
	<!--<link rel="stylesheet"  media="screen" type="text/css" href="css/admin.css">-->
        {!! Html::style('css/admin.css') !!}
	<!--<script type="text/javascript" src="js/jquery.js"></script>-->
        {!! Html::script('js/jquery.js') !!}
	<!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
        {!! Html::script('js/bootstrap.min.js') !!}
<body>
	<header>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
                                    <label class="navbar-brand">Administración SKULLBOOM</label>
<!--					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>-->
                                    
<!--					<a class="navbar-brand" href="#"><b>Admin: Nombre del usuario Admin</b></a>-->
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right">
                                            <li>
                                                    <a href="{{url('/')}}" class="logout"><b></b> <span class="glyphicon glyphicon-home"></span></a>
                                            </li>	
                                            <li>
                                                    <a href="{{url('auth/logout')}}" class="logout"><b>Logout</b> <span class="glyphicon glyphicon-log-out"></span></a>
                                            </li>	
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<div class="menu row">
			<ul class="list-group">
				<li class="list-group-item list-group-item-warning titulo">
					<b class="text-capitalize">Categorías</b>
					<a href="{{url()}}/admin/categorias/create" class="botones"><span class="glyphicon glyphicon-plus"></span></a>
				</li>
                                <!--mostrar categorías-->
                                @foreach($categorias as $categoria)
                                    <li class="list-group-item text-primary">
                                            <a href="{{url()}}/admin/categorias/{{$categoria->id}}"><span class="glyphicon glyphicon-bookmark categoria text-capitalize"> {{$categoria->nombre}}{{substr ($categoria->tipo, 0, 1)}}</span></a>
                                            {!!Form::open(['route'=>['admin.categorias.destroy', $categoria->id], 'method'=>'DELETE'])!!}
                                            <button type="submit"  class="bnt-sin glyphicon glyphicon-trash icon icon-list letra-marron"></button>
                                            {!!Form::close()!!}
                                            <!--<a href="{{url()}}/admin/categorias/create"><span class="glyphicon glyphicon-edit icon icon-list"></span></a>-->
                                            {!! link_to_route('admin.categorias.edit', $tittle='', $parameters = $categoria->id, $attributes = ['class'=>'glyphicon glyphicon-edit icon'])!!}
                                    </li>
                                @endforeach
			</ul>
		</div>	
	</header>
  
    <!--CONTENIDO DE LA PÁGINA-->
    @yield('content')
</body>
</html>