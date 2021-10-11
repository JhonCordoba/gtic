<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficinas;
use App\Edificios;

class OficinasController extends Controller
{

    public function crearOficinas(Request $request){
        
        
        if($request->post("edificio") == "null" || $request->post("nombreOficina") == ""){
            return response()->json( ["mensaje" => "Debes seleccionar un edificio y escribir el nombre de la oficina"] );
        }
        
        $cantidadOficinas = Oficinas::all()->count();
        
        $oficina = new Oficinas;
        
        $oficina->id = ++$cantidadOficinas;
        $oficina->id_edificio_ubicacion = $request->post("edificio");
        $oficina->nombre = $request->post("nombreOficina");
        
        $oficina->save();
        
    }
    
    
    public function getOficinas(){
        
        $oficinas = Oficinas::all(["id" , "id_edificio_ubicacion", "nombre"]);
        
        foreach($oficinas as $oficina){
            $oficina->id_edificio_ubicacion = $this->getNombreEdificioDeLaoficina($oficina->id) . "-" . $oficina->id;
        }
        
        return response()->json( $oficinas );
    }     
    
    public function getNombreOficina($id_oficina){
        
        $oficina = Oficinas::find($id_oficina);

        if($oficina == null){
            return "---";
        }
        else{
            return $oficina->nombre;
        }
    }
    
    public function getNombreEdificioDeLaoficina($id_oficina){
       
        $oficina = Oficinas::find($id_oficina);
        if($oficina == null){
            return "---";
        }        
        
        $edificio = Edificios::find($oficina->id_edificio_ubicacion);
        if($edificio == null){
            return "---";
        }
        else{
            return $edificio->nombre;
        }
        
    }
    
    
    public function getOficinas_arreglo_llave_valor(){
        
        $respuesta =   Oficinas::all(["nombre",  "id"]);
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->nombre]);

        }
            
        return response()->json( $arreglo );
    }    
    
    

}
