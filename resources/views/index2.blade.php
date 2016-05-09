@extends('Layouts.principal')

@section('content')
    <section id="contenido">
        <table>
            <tr>
                <td><!--colspan="2"-->
                    <article>
                        <a href="http://www.dcshoes.es/#?camp=ppc_dc_es-es_e_google_ongoing_ppctxt_ctxt-ex_all_-_brand">
                                <figure>
                                        <img id ="img1" src="img/marca1.jpg" alt="marcas" aria-label="ImagenDeAccesoMarca">
            <!--                            <figcaption>SNACKS</figcaption>					-->
                                </figure>
                        </a>
                    </article>
                </td>
            </tr>
<!--            <tr>
                <td>
                    <article>
                        <a href="http://indosole.com/">
                                <figure>
                                        <img id ="img2" src="img/marca2.jpg" alt="marcas" aria-label="ImagenDeAccesoMarca">
                                        <figcaption>SNACKS</figcaption>					
                                </figure>
                        </a>
                    </article>
                </td>   
                <td>
                    <article>
                        <a href="http://www.quiksilver.es/#?camp=ppc_qs_es-es_e_google_ongoing_ppctxt_ctxt-ex_all_-_brand">
                                <figure>
                                        <img id ="img3" src="img/marca3.jpg" alt="marcas" aria-label="ImagenDeAccesoMarca">
                                        <figcaption>SNACKS</figcaption>					
                                </figure>
                        </a>
                    </article>
                </td>
            </tr>
            <tr>
                <td>
                    <article>
                        <a href="http://www.buff.eu/">
                                <figure>
                                        <img id ="img4" src="img/marca4.jpg" alt="marcas" aria-label="ImagenDeAccesoMarca">
                                        <figcaption>SNACKS</figcaption>					
                                </figure>
                        </a>
                    </article>
                </td>
                <td>
                    <article>
                        <a href="http://www.bluetribe.eu/en/">
                                <figure>
                                        <img id ="img5" src="img/marca5.jpg" alt="marcas" aria-label="ImagenDeAccesoMarca">
                                        <figcaption>SNACKS</figcaption>					
                                </figure>
                        </a>
                    </article>
                </td>
            </tr>-->
            <tr>
                
            @if(Auth::check())
            <td>
            <!--mostramos todos los productos, incluidos los que tienen descuento-->
            @foreach($productos as $producto)
            
                <article id="productoHome" >
                    
                    <a href="{{url()}}/producto/{{$producto->id}}">
                        <figure class="producto">
                            <!--cartel de producto rebajado-->
                            @if($producto->rebaja)
                            <figcaption class="rebajaCartel">-{{$producto->rebaja}}%</figcaption>
                            @endif
                            <img name="imagenProducto" src='{{url($producto->imagen)}}' alt="productos" aria-label="ImagenDeAccesoProducto">
                            <figcaption><p>{{$producto->nombre}}</p></figcaption>
                            <!--PRECIO-->
                            @if($producto->rebaja)
                                <label class="precioAntiguo">{{$producto->precio}}€</label>
                                <figcaption><label class="precio1">{{$producto->precio-(($producto->precio*$producto->rebaja)/100)}}€</label></figcaption>
                            @else
                                <figcaption><label class="precio1">{{$producto->precio}}€</label></figcaption>
                            @endif
                        </figure>
                    </a>
                       
                </article>
            
            @endforeach
            
            </td> 
            @else <!--SI NO ESTÁ CONECTADO...-->
            <td>   
                <?php  
                //Mostramos solo los productos que no tienen descuento aplicado
                foreach($productos as $producto):
                    if(!$producto->rebaja){ ?>
                        <article id="productoHome">
                            <a href="{{url()}}/producto/{{$producto->id}}">
                                <figure class="producto">
                                    <img name="imagenProducto" src='{{url($producto->imagen)}}' alt="productos" aria-label="ImagenDeAccesoProducto">
                                    <figcaption><p>{{$producto->nombre}}</p></figcaption>
                                    <figcaption><label class="precio1">{{$producto->precio}}€</label></figcaption>
                                </figure>
                            </a>
                        </article>
                <?php } 
                endforeach ?>
            </td>
            @endif
              
            </tr>
        </table>
<!--        linea
            <hr id="lineaMarcas"> 
        linea
        <article>
            
            <h2>Las mejores marcas</h2>
                
            <table>
                <tr>
                    <td><a href="http://www.burton.com/"><figure><img id="logoMarcas" src="img/marcas/marca1.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.volcom.es/"><figure><img id="logoMarcas" src="img/marcas/marca2.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.vans.es/"><figure><img id="logoMarcas" src="img/marcas/marca3.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://armadaskis.com/"><figure><img id="logoMarcas" src="img/marcas/marca4.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.roxy.es/"><figure><img id="logoMarcas" src="img/marcas/marca5.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://es.oakley.com/"><figure><img id="logoMarcas" src="img/marcas/marca6.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.dcshoes.es/"><figure><img id="logoMarcas" src="img/marcas/marca7.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://us.billabong.com/global_home.htm"><figure><img id="logoMarcas" src="img/marcas/marca8.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.lib-tech.com/"><figure><img id="logoMarcas" src="img/marcas/marca9.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                </tr>
                <tr>
                    <td><a href="http://www.adidas.es/"><figure><img id="logoMarcas" src="img/marcas/marca10.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.oneill.com/en/home"><figure><img id="logoMarcas" src="img/marcas/marca11.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.quiksilver.es/"><figure><img id="logoMarcas" src="img/marcas/marca12.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.ripcurl.eu/eu/en/"><figure><img id="logoMarcas" src="img/marcas/marca13.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="https://www.electriccalifornia.com/"><figure><img id="logoMarcas" src="img/marcas/marca14.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="https://www.neffheadwear.com/snow"><figure><img id="logoMarcas" src="img/marcas/marca15.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.pennyskateboards.com/eu/es/"><figure><img id="logoMarcas" src="img/marcas/marca16.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://www.horsefeathers.eu/"><figure><img id="logoMarcas" src="img/marcas/marca17.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                    <td><a href="http://ridesnowboards.com/"><figure><img id="logoMarcas" src="img/marcas/marca18.png" alt="marcas" aria-label="ImagenDeAccesoMarca"></figure></a></td>
                </tr>
            </table>
            
	</article>
    linea
            <hr id="lineaMarcas"> 
    linea    -->
    </section>
@stop

    
    