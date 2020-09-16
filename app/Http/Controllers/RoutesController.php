<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{City};

class RoutesController extends Controller
{
    public function calculateDistanceBetweenTwoPoints(){
        $cityA = City::where('name', '=', 'a')->first();
        $cityB = City::where('name', '=', 'b')->first();
        $cityC = City::where('name', '=', 'c')->first();

        $distancia_a_b =  calcDistancia($cityA,$cityB);
        $distancia_a_c =  calcDistancia($cityA,$cityC);
        $distancia_b_c =  calcDistancia($cityB,$cityC);

        echo "teste";
        echo "<br/>";
        print_r($distancia_a_b);
        echo "<br/>";
        print_r($distancia_a_c);
        echo "<br/>";
        print_r($distancia_b_c);
        
    }

}

function calcDistancia(City $cityA, City $cityB)
{
    //Define initial points
    $lat_inicial = $cityA->latitude;
    $long_inicial = $cityA->longitude;
    $lat_final =$cityB->latitude;
    $long_final =$cityB->longitude;

    $d2r = 0.017453292519943295769236;
    $dlong = ($long_final - $long_inicial) * $d2r;
    $dlat = ($lat_final - $lat_inicial) * $d2r;
    $temp_sin = sin($dlat/2.0);
    $temp_cos = cos($lat_inicial * $d2r);
    $temp_sin2 = sin($dlong/2.0);
    $a = ($temp_sin * $temp_sin) + ($temp_cos * $temp_cos) * ($temp_sin2 * $temp_sin2);
    $c = 2.0 * atan2(sqrt($a), sqrt(1.0 - $a));
    return 6368.1 * $c;
}
