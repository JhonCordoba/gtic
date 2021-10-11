<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tareas;
use App\Tipo_tareas; 

use App\Http\Controllers\UsersController;

use Auth;

class TareasController extends Controller
{
    
    private $usersController;
    
    public function __construct() {
        auth()->setDefaultDriver("api");
        $this->usersController = new UsersController();
    }    

 
    
    public function index(){}
    public function show($id){return $id;}

    public function getTareasSinFinalizar(){

        $tareas = Tareas::where( "id_usuario", 0 )->where("id_usaurio_asigno", 0 )->where("finalizada", "!==", 1)->get();
        
        for($i = 0; $i < sizeof($tareas); $i++){
           
            $tareas[$i]->descripcion = $tareas[$i]->descripcion . "-" . $tareas[$i]->id;
            $tareas[$i]->asignadaPor = "A petición de: " . $this->usersController->getNombreUsuario( $tareas[$i]->id_usaurio_asigno ) . "-" . $tareas[$i]->id_usaurio_asigno;
            $tareas[$i]->tipoTarea = $this->getNombreTipoTarea( $tareas[$i]->id_tipo_tarea );
         
        }
        
        return $tareas;        
        
    }
    
    public function marcarTareaComoRealizada(Request $request){
        
        $tarea = Tareas::find( $request->get("id_tarea") );
        
        //Validamos que la tarea sea de él
        if($tarea->id_usuario != Auth::id()){
            return "Error: la tarea no es tuya";
        }
        
        $tarea->finalizada = 1;
        $tarea->save();
        
    }
    
    public function getTareas(){

        $tareas = Tareas::where( "id_usuario", Auth::id() )->orWhere("id_usaurio_asigno", Auth::id())->orderBy('updated_at', 'desc')->get();
        
        $tareasArray = [];
        
        for($i = 0; $i < sizeof($tareas); $i++){
           
            $tareas[$i]->descripcion =  $tareas[$i]->descripcion;
            $tareas[$i]->asignadaPor = $this->usersController->getNombreUsuario( $tareas[$i]->id_usaurio_asigno ) . "-" . $tareas[$i]->id_usaurio_asigno;
            $tareas[$i]->tipoTarea = $this->getNombreTipoTarea( $tareas[$i]->id_tipo_tarea );
            $tareas[$i]->asignada_a = $this->usersController->getNombreUsuario( $tareas[$i]->id_usuario );
            
            array_push($tareasArray, [$tareas[$i]->finalizada, $tareas[$i]->descripcion, $tareas[$i]->titulo, $tareas[$i]->asignadaPor, $tareas[$i]->asignada_a, $tareas[$i]->tiempo_requerido_minutos  , $tareas[$i]->tipoTarea, $tareas[$i]->created_at->format('m/d/Y'), $tareas[$i]->id ]);
        }
        
        return $tareasArray;
        
    }
    
    public function getNombreTipoTarea($id_tipo_tarea){
        
        return Tipo_tareas::where("id", $id_tipo_tarea)->first()->nombre;
        
    }
    
    public function crearTarea(Request $request){
        
        $cantidadTareas = sizeof( Tareas::all() );
        
        $tarea = new Tareas;
        $tarea->id = $cantidadTareas + 1;
        $tarea->id_tipo_tarea = $request->get("categoria");
        $tarea->id_usuario = ( $request->get("usuario_asignar") == -1) ? Auth::id() : $request->get("usuario_asignar");
        $tarea->id_usaurio_asigno = Auth::id();
        $tarea->titulo = $request->get("titulo");
        $tarea->descripcion = $request->get("descripcion");
        $tarea->tiempo_requerido_minutos = $request->get("tiempo_requerido_minutos");
        $tarea->finalizada = $request->get("finalizada");
        $tarea->save();
        
    }
    
    public function actualizarTarea(Request $request){
        
        
        $tarea = Tareas::find($request->id);
        
        if( $tarea->id_usuario != Auth::id() && $tarea->id_usuario_asigno != Auth::id() )
            return "Error: No eres propietario de esa tarea";
        
        if($request->get("id_tipo_tarea") != -1 && $request->get("id_tipo_tarea") != null) 
            $tarea->id_tipo_tarea = $request->get("id_tipo_tarea");
        
        if($request->get("usuario_asignar") != -1 && $request->get("usuario_asignar") != null) 
            $tarea->id_usuario = $request->get("usuario_asignar");
        
        
        $tarea->titulo = $request->get("titulo");
        $tarea->descripcion = $request->get("descripcion");
        $tarea->tiempo_requerido_minutos = $request->get("tiempo_requerido_minutos");
        $tarea->finalizada = $request->get("finalizada");
        $tarea->save();        
    }
    
    public function eliminarTarea(Request $request){

        $tarea = Tareas::find($request->id_tarea);
        $tarea->delete();
        
    }    
    
    public function getTiposTareas(){

        $tipoTareas = Tipo_tareas::where( "id_usuario", Auth::id() )->get();
        
        $tipoTareasArray = [];
        
        for($i = 0; $i < sizeof($tipoTareas); $i++){
           
            $tipoTareas[$i]->nombre = $this->getNombreTipoTarea( $tipoTareas[$i]->id );
         
            array_push($tipoTareasArray, [ $tipoTareas[$i]->nombre, $tipoTareas[$i]->descripcion ]);
        }
        
        return $tipoTareasArray;        
    }

    public function crearTiposTareas(Request $request){
        
        $cantidad = sizeof( Tipo_tareas::all() );
        
        $TipoTarea = new Tipo_tareas;
        $TipoTarea->id = $cantidad + 1;
        $TipoTarea->id_usuario = Auth::id();
        $TipoTarea->nombre = $request->get("nombre");
        $TipoTarea->descripcion = $request->get("descripcion");
        $TipoTarea->save();        
        
    }
    
    public function tipoTareas_arreglo_llave_valor(){
     
        $respuesta = Tipo_tareas::select(["id" , "nombre", "descripcion"])->where("id_usuario", Auth::id() )->get();
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->nombre]);

        }
            
        return response()->json( $arreglo );        
    }
    
}
