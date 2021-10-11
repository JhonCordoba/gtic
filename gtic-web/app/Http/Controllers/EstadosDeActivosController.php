<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EstadosDeActivos;

class EstadosDeActivosController extends Controller
{
    
    public function crearEstado(Request $request){
        
        $estado = new EstadosDeActivos;
        
        $cantidadEstados = EstadosDeActivos::all()->count();
        
        $estado->id = ++$cantidadEstados;
        $estado->nombre = $request->post("nombre");
        $estado->descripcion = $request->post("descripcion");
        
        $estado->save();
        
    }
    
    public function getEstados(){
        
       $estados = EstadosDeActivos::all(["nombre", "descripcion"]);
       
        return response()->json( $estados );
    }         
    
    
    public function getNombreEstadoDeActivo($id_estado){
    
        $estado = EstadosDeActivos::find($id_estado);
        if($estado == null){
            return "---";
        }
        else{
            return $estado->nombre;
        }
    }
    
    
    public function getEstados_arreglo_llave_valor(){
        
        $respuesta =   EstadosDeActivos::all(["nombre", "id"]);
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->nombre]);

        }
            
        return response()->json( $arreglo );
    }      
    
    
    
}
