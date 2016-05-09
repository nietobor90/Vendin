<?php namespace App\Http\Controllers;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;


class SoapController extends Controller{

    public function mapa()
    {
        // Add a new service to the wrapper
        SoapWrapper::add(function ($service) {
            $service
                ->name('geolocation')
                ->wsdl('http://www.ipswitch.com/netapps/geolocation/iplocate.asmx?WSDL')
                ->trace(true)                                               
                ->cache(WSDL_CACHE_NONE);                                        
                
        });
        
        //Array con Ips de diferentes localizaciones
        $IPs = ['81.61.152.228', '90.161.19.207', '85.137.159.254', '81.202.131.48'];//
        //Seleccionamos IP aleatoria
        $IP   = $IPs[array_rand($IPs)];
        //array de datos con indice y valor de IP
        $data = ['sIPAddress' => $IP];
        //Inicializamos variable $dataLocation a null
        $dataLocation = null;

        // Usando el servicio añadido
        SoapWrapper::service('geolocation', function ($service) use ($data, &$dataLocation) {
            //hacemos la llamada
            $dataLocation = $service->call('GetLocationRawOutput', [$data])->GetLocationRawOutputResult;
        });
        
        //SACAMOS REGION del objeto $dataLocation
        $region = $dataLocation->geolocation_data->region_name;
        
        //SWITCH DE REGIÓN
        switch ($region){
            case 'Madrid':
                $lat = 40.4530582;
                $lng = -3.6905332;
                $address = "Av de Concha Espina, 1,28036 Madrid";
                break;
            case 'Andalucia':
                $lat = 37.3840697;
                $lng = -5.9728789;
                $address = "Calle Sevilla Fútbol Club, s/n,41005 Sevilla";
                break;
            case 'Comunidad Valenciana':
                $lat = 39.4701221;
                $lng = -0.3684517;
                $address = "Av. de Suècia, s/n,46010 València,Valencia";
                break;
            case 'Catalonia':
                $lat = 41.3809;
                $lng = 2.1206311;
                $address = "C. Aristides Maillol, 12,08028 Barcelona";
                break;
        }
        
        //REDIRECCIÓN A VISTA CON LOS PARAMETROS
        return view('mapa/mapa', ['lat'=>$lat, 'lng'=>$lng, 'add'=> $address]);
    }

}

