<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propiedades_computador;

class Propiedades_computadorController extends Controller
{
    public function getPropiedadesDelComputador($id_activo) {
        
        if( Propiedades_computador::find($id_activo) == null ){
            
            return null;
        
        }else{
            
            return Propiedades_computador::find($id_activo);
        
        } 
        
    }

    public function getActivosPorFiltroIP($ipFilter){
       $ids = Propiedades_computador::select("id_activo")->where("IPaddress", "LIKE", "%{$ipFilter}%")->get();
        $response = [];
       foreach ($ids as $id) {
            array_push($response, $id->id_activo);
        }
        return $response;
    }
}
