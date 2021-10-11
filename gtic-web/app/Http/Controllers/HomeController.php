<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\InventarioController;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        /*        

        //Si no ha cambiado su contraseña le muestra el formulario para que la cambie
        $userController = new UsersController();
        
        //Si no ha cambiado la contraseña todavía...
        if( !$userController->yaCambioElPassword( Auth::id() )){
            
            return view("auth.passwords.change_password");
            
        }
        
        
        $movimientosController = new MovimientosController;
        $tareas = new TareasController;
        $userController = new UsersController();
        $inventarioController = new InventarioController();
                
        $prestamos = $movimientosController->getPrestamos();
        $movimientos = $movimientosController->getUltimosMovimientos();
        $tareas_sin_finalizar = $tareas->getTareasSinFinalizar();
        $activos_mantenimiento = $inventarioController->getActivosRequierenMantenimiento();
        
        
        foreach ($activos_mantenimiento as $activo) {
            
            $tarea_mantenimiento = new \stdClass();
            $tarea_mantenimiento->id = -1; //Còdigo para tareas de mantenimiento.
            $tarea_mantenimiento->titulo = "Mantenimiento requerido";
            $tarea_mantenimiento->descripcion = "Se debe realizar mantenimiento al activo con número de inventario " . $activo->numero_inventario ." (" . $activo->nombre . ")";
            $tarea_mantenimiento->asignadaPor = "Recordatorio del Sistema de Gestión Tecnológica";
            $tarea_mantenimiento->tipoTarea = "Recordatorio del SGT";
            
            $tareas_sin_finalizar->push($tarea_mantenimiento);
            
        }
        
        */
        return view('home');
    }
}
