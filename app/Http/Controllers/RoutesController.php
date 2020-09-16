<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{City};
use Illuminate\Support\Facades\Storage;
use DB;


class RoutesController extends Controller
{
    public function getRoutes(){

        $cityA = City::where('name', '=', 'a')->first();
        $cityB = City::where('name', '=', 'b')->first();
        $cityC = City::where('name', '=', 'c')->first();

        $distancia_a_b =  calcDistancia($cityA,$cityB);
       

        echo "teste";
        echo "<br/>";
        print_r($distancia_a_b);
        echo "<br/>";
        print_r($distancia_a_c);
        echo "<br/>";
        print_r($distancia_b_c);
        
    }

    public function calculateDistanceBetweenTwoPoints(Request $request){
        
        $file = $request->file('file');
        if(empty($file)) {
            return back()->with('error','arquivo não enviado');
        }

        $rotas = array();
        $distances = array();

        //file upload
        $arquivo = $file->store('upload');
        $file = fopen(storage_path('app/'.$arquivo), "r");
        $array_routes = array();
        while(!feof($file)) {
            $linha = explode(',',trim(preg_replace('/\s\s+/', ' ',fgets($file))));

            $cityA = City::where('name', '=', $linha[0])->first();
            $cityB = City::where('name', '=', $linha[1])->first();

            $distance_a_b =  calcDistancia($cityA,$cityB);
            $rota = array($linha[0],$linha[1],$distance_a_b);
            
            array_push($rotas,$rota);

        
        }        
        fclose($file);

        $array_sorted = array_sort($rotas, 2, SORT_ASC);

        $data = [
            'cities' => City::all(),
            'array' => $array_sorted,
        ];
        return view('home')->with('data',$data);

        
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

//fuction to sort any array
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
