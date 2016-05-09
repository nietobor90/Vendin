@extends('Layouts.principal')
@section('content')

<section id="contenidoMapa">
    <div id="coor"  data-lat="{{$lat}}" data-lng="{{$lng}}" data-add="{{$add}}"></div>
    <div id="address"><label>{{$add}}</label></div>
    <div id="map" style="width: 500px; height: 400px;"></div>
    
    <script type="text/javascript">
        var map, marker;
        
        function init(){
            //variables de latitud y longitud
            var lat = parseFloat(document.getElementById('coor').dataset.lat);
            var lng = parseFloat(document.getElementById('coor').dataset.lng);
            
            //opciones del mapa
            var mapOptions = {
                //coordenadas del punto del centro del mapa
                center: {lat:lat, lng:lng},
                //zoom
                zoom: 17,
                //tipo de mapa (MAPA DE CARRETERAS)
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            //mapa
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            //marca del mapa
            marker = new google.maps.Marker({
                position: {lat:lat, lng:lng},
                map: map,
                title: 'SkullBoom'
            });
        }
        
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3A1SVpN9GhSAmWkZB7AXUif6fElN8mg0&callback=init">
    </script>
</section>
@stop

