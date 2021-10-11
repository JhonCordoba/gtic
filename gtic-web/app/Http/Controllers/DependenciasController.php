<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;

use Illuminate\Http\Request;

use App\Dependencias;

class DependenciasController extends Controller
{


    public function crearDependencia(Request $request){
        
        $cantidadDependencias = Dependencias::all()->count();
        
        $dependencia = new Dependencias;
        
        $dependencia->id = ++$cantidadDependencias;
        $dependencia->descripcion = $request->get("descripcionDependencia");
        $dependencia->nombre = $request->get("nombreDependencia");
        
        $dependencia->save();
        
        
    }
    
    
    public function getDependencias(){
        return response()->json( Dependencias::all(["nombre", "descripcion"]) );
    }
    
    
    public function getDependencias_arreglo_llave_valor(){
        
        $respuesta =   Dependencias::all(["nombre", "id"]);
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->nombre]);

        }
            
        return response()->json( $arreglo );
    }
}
