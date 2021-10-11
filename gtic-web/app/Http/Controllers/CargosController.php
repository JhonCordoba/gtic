<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cargos;

class CargosController extends Controller
{
    
    
    public function crearCargos(Request $request){
        
        $cantidadDeCargos = Cargos::all()->count();
        
        $cargos = new Cargos;
        
        $cargos->id = ++$cantidadDeCargos;
        $cargos->nombre = $request->get("nombreCargo");
        $cargos->descripcion = $request->post("descripcionCargo");
        
        $cargos->save();
        
    }
    
    
    public function getCargos(){
        return response()->json( Cargos::all(["nombre", "descripcion"]) );
    }    
    
    public function getCargos_arreglo_llave_valor(){
        
        $respuesta =   Cargos::all(["nombre", "id", "descripcion"]);
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->nombre]);

        }
            
        return response()->json( $arreglo );
    }    
    
    
}
