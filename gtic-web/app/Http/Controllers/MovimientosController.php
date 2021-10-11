<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\InventarioController;
use App\Inventario;
use App\Movimientos;
use App\User;
use Auth;
use Response;
use Hash;
use Illuminate\Support\Facades\DB;

class MovimientosController extends Controller
{
    private $usersController;
    private $inventarioController;
    
    public function __construct() {
        $this->usersController = new UsersController();
        $this->inventarioController = new InventarioController();
    }    
    
    public function getMovimientos(){
        
        $movimientosArray = array();

        //si no es root
        if( !$this->usersController->esRoot(Auth::id()) ){

            $activos_responsable = Inventario::select("id")->where( "id_funcionario_responsable", Auth::id() )->get();
            $activos_responsable_array = array();
            foreach ($activos_responsable as $activo) {
                array_push($activos_responsable_array, $activo->id);
            }


            $movimientos = Movimientos::all(["idUsuarioSolicito", "id_activo" , "observaciones", 'updated_at', 'yaDevuelto', 'id'])->whereIn("id_activo", $activos_responsable_array)->sortByDesc('updated_at');

        }else if( $this->usersController->esRoot(Auth::id()) ){

            $movimientos = Movimientos::all(["idUsuarioSolicito", "id_activo" , "observaciones", 'updated_at', 'yaDevuelto', 'id'])->sortByDesc('updated_at');

        }

        if( $this->usersController->esUsuarioBasico(Auth::id()) ){


            //Como un usuario básico no puede ser responsable de ningún activo, porque pasaría a ser un administrador
            //para obtener la lista de sus movimientos, solo se debe traer los movimientos en donde él sea el solicitante
            $movimientos = Movimientos::all(["idUsuarioSolicito", "id_activo" , "observaciones", 'updated_at', 'yaDevuelto', 'id'])->where("idUsuarioSolicito",  Auth::id() );

        }

        
        foreach($movimientos as $movimiento){
            
            
            $activo = Inventario::find( $movimiento->id_activo);
         
            $movimiento->idUsuarioSolicito = $this->usersController->getNombreUsuario($movimiento->idUsuarioSolicito) . "-" . $movimiento->idUsuarioSolicito;
        
            $movimiento->id_activo = $activo->nombre . "-" . $activo->numero_inventario . "-" . $movimiento->id;
            
            
            if($movimiento->yaDevuelto === null)
                $movimiento->yaDevuelto = "---";
            
            
            array_push($movimientosArray, [$movimiento->idUsuarioSolicito, $movimiento->id_activo, $movimiento->observaciones, $movimiento->updated_at->format("m/d/Y H:m"), $movimiento->yaDevuelto]);
        }
        
        return response()->json( $movimientosArray );
    }
    
    public function getPrestamos(){
        
        $id_funcionario_responsable = Auth::id();

        //Si es root le muestra todos los prestamos sin finalizar:
        if( $this->usersController->esRoot(Auth::id()) )
            $movimienotos = Movimientos::where('yaDevuelto', "0")->get();
        else//si no, se muestra solo los prestamos sin finalizar de sus activos
            $movimienotos = DB::select( DB::raw("SELECT * FROM movimientos, activos WHERE movimientos.yaDevuelto = 0 AND activos.id_funcionario_responsable = '$id_funcionario_responsable' AND movimientos.id_activo = activos.id") );

        for($i = 0; $i < sizeof($movimienotos); $i++ ){
            $movimienotos[$i]->solicitado_por = $this->usersController->getNombreUsuario($movimienotos[$i]->idUsuarioSolicito);
            $movimienotos[$i]->nombreActivo = $this->inventarioController->getNombreActivo($movimienotos[$i]->id_activo) . "-" . $this->inventarioController->getNumeroInventario($movimienotos[$i]->id_activo) ;
            $movimienotos[$i]->firmoRecibido = ($movimienotos[$i]->recibido == null || $movimienotos[$i]->recibido == 0) ? "NO" : "SÍ"; 
            
        }
        
        return $movimienotos;
    }
    
    public function getUltimosMovimientos(){
        
        $movimientos = Movimientos::where("yaDevuelto", null)->orderBy('updated_at', 'desc')->take(10)->get();
        
        for($i = 0; $i < sizeof($movimientos); $i++ ){
            $movimientos[$i]->solicitado_por = $this->usersController->getNombreUsuario($movimientos[$i]->idUsuarioSolicito);
            $movimientos[$i]->nombreActivo = $this->inventarioController->getNombreActivo($movimientos[$i]->id_activo) . "-" . $this->inventarioController->getNumeroInventario($movimientos[$i]->id_activo) ;
        }
        
        return $movimientos;
    }    
    
    public function crearPrestamo(Request $request){
        

        $activo = Inventario::find($request->id_activos);
        $mensaje = "Se registró el prestamo con éxito";
        
        //Solo el responsable del activo con perfil ADMINISTRADOR pueden modificarlo y el usuario ROOT
        if( !$this->usersController->esRoot(Auth::id()) )
            if($activo[0]->id_funcionario_responsable != Auth::id() || !$this->usersController->esAdministrador( Auth::id() )){
                return Response::json(["mensaje" => "No puedes prestar este activo, porque no eres el responsable. RESPONSABLE DEL ACTIVO: " . $this->usersController->getNombreUsuario($activo[0]->id_funcionario_responsable), "codigo" => -1 ] );
            }        
        
         $recibido = 0;   
        //Verificamos que el password_recibido sea correcto. Si no ingresó el password no se hace la verificación
        if(null != $request->password_recibido && "" != $request->password_recibido){
            if( !Hash::check( $request->password_recibido, $this->usersController->getHashPassword( $request->idUsuarioSolicito ) )  ){
                return Response::json(["mensaje" => "La contraseña del usaurio no es correcta, por favor intenta nuevamente", "codigo" => -2 ] );
            }
            else              
                $recibido = 1;
        }

        //si no ha cambiado la contraseña y no ingresó una nueva contraseña para cambiarla...
        if( Hash::check( "1234", $this->usersController->getHashPassword( $request->idUsuarioSolicito ) )  && $request->password_nueva == null  ){
            return Response::json(["mensaje" => "El usuario debe cambiar la contraseña por defecto " . $request->password_nueva, "codigo" => -2 ] );
        }else if($request->password_nueva != null){

            $mensaje = "Se cambió la contraseña con éxito";
            //Cambio de contraseña por defecto...
            $user = User::find($request->idUsuarioSolicito);
            $user->password = Hash::make($request->password_nueva);
            $user->update();
            $recibido = 1;//Cuando cambia la contraseña se firma el recibido por defecto
        }           

        //por cada activo seleccionado:
        for($i = 0; $i < sizeof($request->id_activos); $i++ ){
            
            //Verificamos que el activo no esté prestado
                $movimiento = Movimientos::where("yaDevuelto", 0)->where("id_activo", $request->id_activos[$i])->get();
                if(sizeof($movimiento) >= 1)
                    return Response::json(["mensaje" => "Este activo ya está prestado, primero debes registrar que ya te lo habían entregado", "codigo" => -3 ] );

            $movimiento = new Movimientos;
            $movimiento->id_activo = $request->id_activos[$i];
            $movimiento->idUsuarioSolicito = $request->idUsuarioSolicito;
            $movimiento->observaciones = $request->observaciones;
            $movimiento->yaDevuelto = $request->yaDevuelto;
            $movimiento->Recibido = $recibido;
            $movimiento->save();            
        }

        return Response::json(["mensaje" => $mensaje, "codigo" => -4 ]);
        
    }

    public function actualizarMovimiento(Request $request){
        
        if( $this->usersController->esUsuarioBasico(Auth::id()) ){

            return Response::json(["mensaje" => "No tienes los permisos para realizar esta acción. Solicita ayuda del administrador.", "codigo" => -3 ] );

        }

        //nombre-numerdeinventario-id_movimiento
        $id_movimiento = explode("-", $request->get("id_movimiento"));
        
        $movimiento = Movimientos::find(  $id_movimiento[2]  );
        
        if (null == $movimiento) {
            return Response::json("No se encuentra ningun activo con id: " + $request->get("id"));
            die();
        }                
        
        $movimiento->yaDevuelto = $request->get("ya_devuelto");
        $movimiento->observaciones = $request->get("observaciones");
        $movimiento->save();
    }
    
}