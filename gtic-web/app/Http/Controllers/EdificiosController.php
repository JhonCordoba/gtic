<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Edificios;

class EdificiosController extends Controller
{
    public function crearEdificios(Request $request){
        
        $id = sizeof( Edificios::all() );
        
        
        $edificio = new Edificios;
        
        $edificio->id = ++$id;
        $edificio->nombre = $request->post("nombreEdificio");
        $edificio->direccion = $request->post("direccionEdificio");
        
        $edificio->save();
        
    }
    
    
    public function getEdificios(){
        return response()->json( Edificios::all(["nombre", "direccion"]) );
    }    
    
    public function getEdificios_arreglo_llave_valor(){
        
        $respuesta =   Edificios::all(["nombre", "direccion", "id"]);
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->nombre]);

        }
            
        return response()->json( $arreglo );
    }
}
