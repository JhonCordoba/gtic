<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propiedades_computador;

class Propiedades_computadorController extends Controller
{
    public function getPropiedadesDelComputador($id_activo) {
        
        if( Propiedades_computador::find($id_activo) == null || Propiedades_computador::find($id_activo)->nombre_equipo == null ){
            
            return null;
        
        }else{
            
            return Propiedades_computador::find($id_activo);
        
        } 
        
    }
}
