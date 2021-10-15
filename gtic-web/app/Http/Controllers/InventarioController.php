<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\ComposicionActivos;
use App\Movimientos;
use App\Propiedades_computador;
use App\Http\Controllers\Propiedades_computadorController;
use App\Http\Controllers\OficinasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EstadosDeActivosController;
use Importer;
use Response;
use Auth;
use Error;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InventarioController extends Controller {

    private $oficinasController;
    private $usersController;
    private $estadosActivosController;

    public function __construct() {
        $this->oficinasController = new OficinasController();
        $this->usersController = new UsersController();
        $this->estadosActivosController = new EstadosDeActivosController();
    }

    public function getListaInventario() {

        //TODO: Pagination
        if( $this->usersController->esRoot(Auth::id()) ){
            $activos = Inventario::all();
        }else{
            $activos = Inventario::where("id_funcionario_responsable", Auth::id())->get();
        }

        $propiedadesComputador = new Propiedades_computadorController();
        $activosConSusPropiedades = [];

        foreach ($activos as $activo) {

            $activo->nombre_oficina_ubicacion = $this->oficinasController->getNombreOficina($activo->id_oficina_ubicacion);
            $activo->edificio = $this->oficinasController->getNombreEdificioDeLaoficina($activo->id_oficina_ubicacion);
            $activo->nombre_funcionario_responsable = $this->usersController->getNombreUsuario($activo->id_funcionario_responsable);
            $activo->nombre_usuario = $this->usersController->getNombreUsuario($activo->id_usuario);
            $activo->nombre_estado_de_activo = $this->estadosActivosController->getNombreEstadoDeActivo($activo->id_estado);

            $propiedades = $propiedadesComputador->getPropiedadesDelComputador($activo->id);


            array_push($activosConSusPropiedades, [$activo, $propiedades]);
        }


        array_push($activosConSusPropiedades, $activos);


        return response()->json($activosConSusPropiedades);
    }

    public function filtrar_inventario(Request $request){
        $numero_inventario = ($request->get('numero_inventario') == null) ? "" : $request->get('numero_inventario') ;
        $nombre = ($request->get('nombre') == null) ? "" : $request->get('nombre') ;
        $marca = ($request->get('marca') == null) ? "" : $request->get('marca');
        $id_oficina = ($request->get('oficina') == "null") ? "" : $request->get('oficina') ;
        $id_responsable = ($request->get('id_responsable') == "null") ? "" : $request->get('id_responsable') ;
        $id_usuario = ($request->get('id_usuario') == "null") ? "" : $request->get('id_usuario') ;
        $funciona_correctamente = ($request->get('funciona_correctamente') == "null") ? "---" : $request->get('funciona_correctamente') ;
        $observaciones = ($request->get('observaciones') == "null") ? "" : $request->get('observaciones');
        $id_estado = ($request->get('estado') == "null") ? "" : $request->get('estado');
        $fecha_ultima_revision = ($request->get('fecha_ultima_revision') == "null") ? "" : $request->get('fecha_ultima_revision');
        $serial = ($request->get('serial') == "null") ? "" : $request->get('serial');
        $fecha_aceptacion = ($request->get('fecha_aceptacion') == "null") ? "" : $request->get('fecha_aceptacion');
        $datos_proveedor = ($request->get('datos_proveedor') == "null") ? "" : $request->get('datos_proveedor');
        $numero_factura = ($request->get('numero_factura') == "null") ? "" : $request->get('numero_factura');
        $es_computador =  ($request->get('es_computador') == "null") ? "---" : $request->get('es_computador');
        
        if($funciona_correctamente == "---" &&  $es_computador == "---"){

            $activos = Inventario::where("numero_inventario", "LIKE",  "%{$numero_inventario}%" )
                    ->where("nombre", "LIKE",  "%{$nombre}%")
                    ->where("marca_referencia", "LIKE",  "%{$marca}%")
                    ->where("id_oficina_ubicacion", "LIKE",  "%{$id_oficina}%")
                    ->where("id_funcionario_responsable", "LIKE",  "%{$id_responsable}%")
                    ->where("id_usuario", "LIKE",  "%{$id_usuario}%")
                    //->where("funciona_correctamente", "=",  $funciona_correctamente)
                    ->where("observaciones", "LIKE",  "%{$observaciones}%")
                    ->where("id_estado", "LIKE",  "%{$id_estado}%")
                    ->where("ultima_revision_estado", "LIKE",  "%{$fecha_ultima_revision}%")
                    ->where("numero_serial", "LIKE",  "%{$serial}%")
                    ->where("fecha_aceptacion", "LIKE",  "%{$fecha_aceptacion}%")
                    ->where("datos_contacto_proveedor", "LIKE",  "%{$datos_proveedor}%")
                    ->where("numero_factura", "LIKE",  "%{$numero_factura}%")
                    //->where("es_computador", "=",  $es_computador)
                    ->get();  
        }else if($funciona_correctamente == "---"){
            $activos = Inventario::where("numero_inventario", "LIKE",  "%{$numero_inventario}%" )
                    ->where("nombre", "LIKE",  "%{$nombre}%")
                    ->where("marca_referencia", "LIKE",  "%{$marca}%")
                    ->where("id_oficina_ubicacion", "LIKE",  "%{$id_oficina}%")
                    ->where("id_funcionario_responsable", "LIKE",  "%{$id_responsable}%")
                    ->where("id_usuario", "LIKE",  "%{$id_usuario}%")
                    //->where("funciona_correctamente", "=",  $funciona_correctamente)
                    ->where("observaciones", "LIKE",  "%{$observaciones}%")
                    ->where("id_estado", "LIKE",  "%{$id_estado}%")
                    ->where("ultima_revision_estado", "LIKE",  "%{$fecha_ultima_revision}%")
                    ->where("numero_serial", "LIKE",  "%{$serial}%")
                    ->where("fecha_aceptacion", "LIKE",  "%{$fecha_aceptacion}%")
                    ->where("datos_contacto_proveedor", "LIKE",  "%{$datos_proveedor}%")
                    ->where("numero_factura", "LIKE",  "%{$numero_factura}%")
                    ->where("es_computador", "=",  $es_computador)
                    ->get();             
        }else if($es_computador == "---"){
            
            $activos = Inventario::where("numero_inventario", "LIKE",  "%{$numero_inventario}%" )
                    ->where("nombre", "LIKE",  "%{$nombre}%")
                    ->where("marca_referencia", "LIKE",  "%{$marca}%")
                    ->where("id_oficina_ubicacion", "LIKE",  "%{$id_oficina}%")
                    ->where("id_funcionario_responsable", "LIKE",  "%{$id_responsable}%")
                    ->where("id_usuario", "LIKE",  "%{$id_usuario}%")
                    ->where("funciona_correctamente", "=",  $funciona_correctamente)
                    ->where("observaciones", "LIKE",  "%{$observaciones}%")
                    ->where("id_estado", "LIKE",  "%{$id_estado}%")
                    ->where("ultima_revision_estado", "LIKE",  "%{$fecha_ultima_revision}%")
                    ->where("numero_serial", "LIKE",  "%{$serial}%")
                    ->where("fecha_aceptacion", "LIKE",  "%{$fecha_aceptacion}%")
                    ->where("datos_contacto_proveedor", "LIKE",  "%{$datos_proveedor}%")
                    ->where("numero_factura", "LIKE",  "%{$numero_factura}%")
                    //->where("es_computador", "=",  $es_computador)
                    ->get();             
            
        }
        
        $propiedadesComputador = new Propiedades_computadorController();
        $activosConSusPropiedades = [];

        foreach ($activos as $activo) {

            $activo->nombre_oficina_ubicacion = $this->oficinasController->getNombreOficina($activo->id_oficina_ubicacion);
            $activo->edificio = $this->oficinasController->getNombreEdificioDeLaoficina($activo->id_oficina_ubicacion);
            $activo->nombre_funcionario_responsable = $this->usersController->getNombreUsuario($activo->id_funcionario_responsable);
            $activo->nombre_usuario = $this->usersController->getNombreUsuario($activo->id_usuario);
            $activo->nombre_estado_de_activo = $this->estadosActivosController->getNombreEstadoDeActivo($activo->id_estado);

            $propiedades = $propiedadesComputador->getPropiedadesDelComputador($activo->id);

            array_push($activosConSusPropiedades, [$activo, $propiedades]);
        }

        return response()->json($activosConSusPropiedades);
        
    }
    
    public function registrarActivo(Request $request) {

        $cantidadActivos = Inventario::all()->count();
        try {

            $activo = new Inventario();
            $activo->id = ++$cantidadActivos;
            $activo->numero_inventario = $request->get("numero_inventario");
            $activo->numero_serial = $request->get("numero_serial");
            $activo->nombre = $request->get("nombre");
            $activo->marca_referencia = $request->get("marca_referencia");
            $activo->observaciones = $request->get("observaciones");
            $activo->fecha_aceptacion = $request->get("fecha_aceptacion");
            $activo->id_estado = $request->get("id_estado");
            $activo->id_oficina_ubicacion = $request->get("id_oficina");
            $activo->costo_inicial = $request->get("costo_inicial");
            $activo->ultima_revision_estado = $request->get("fecha_ultima_revision");
            $activo->id_funcionario_responsable = $request->get("id_funcionario_responsable");
            $activo->id_usuario = $request->get("id_usuario");
            $activo->funciona_correctamente = $request->get("funciona_correctamente");
            $activo->datos_contacto_proveedor = $request->get("datos_contacto_proveedor");
            $activo->fecha_fin_garantia = $request->get("fecha_fin_garantia");
            $activo->numero_factura = $request->get("numero_factura");
            $activo->es_computador = $request->get("es_computador");
            $activo->ultimo_mantenimiento = $request->get("ultimo_mantenimiento");
            $activo->cada_cuantos_dias_mantenimiento = $request->get("cada_cuantos_dias_mantenimiento");
            $activo->save();

            //Si es un computador, guardamos las propiedades del computador
            if ($request->get("es_computador") == 1) {
                $propiedades_computador = new Propiedades_computador();
                $propiedades_computador->id_activo = $cantidadActivos;
                $propiedades_computador->nombre_equipo = $request->get("nombre_computador"); 
                $propiedades_computador->tipo_escritorio_portatil = $request->get("tipo_escritorio_portatil");
                $propiedades_computador->MACaddress = $request->get("MACaddress");
                $propiedades_computador->IPaddress = $request->get("IPaddress");
                $propiedades_computador->ip_puerta_enlace = $request->get("ip_puerta_enlace");
                $propiedades_computador->capacidad_ram = $request->get("capacidad_ram");
                $propiedades_computador->capacidad_almacenamiento = $request->get("capacidad_almacenamiento");
                $propiedades_computador->cantidad_tarjeta_red_inalambrica = $request->get("cantidad_tarjeta_red_inalambrica");
                $propiedades_computador->cantidad_tarjeta_red_alambrica = $request->get("cantidad_tarjeta_red_alambrica");
                $propiedades_computador->save();
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return [ "mensaje" => 'Error al insertar el activo:\\n"' . $ex->getMessage(), "codigo" => -1 ];
            
        }
        
        return [ "mensaje" => 'Se guardó con éxito', "codigo" => 0 ];
        
    }

    public function registrarActivos() {

        DB::transaction(function() { 


            //Verifica que se haya seleccionado un archivo
            if ($_FILES['activos']['tmp_name'] == NULL) {
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('NO SE SELECCIONÓ EL ARCHIVO');
                    window.location.href='/';
                    </script>");
            }

            $tmp_name = $_FILES['activos']['tmp_name'];

            if (move_uploaded_file($tmp_name, $tmp_name)) {
                
    
                $excel = Importer::make('Excel');
                $excel->load($tmp_name);
                $collection = $excel->getCollection();

                $cantidadActivos = Inventario::all()->count();

                $i = 0;
                try {

                    for ($i = 1; $i < sizeof($collection); $i++) {

                        if(!$collection[$i][0] && !$collection[$i][1])
                         break;
                         //throw new Error("debes indicar al menos una de las siguientes propiedades: Número de inventario o Serial");

                        $activo = new Inventario();
                        $activo->id = ++$cantidadActivos;
                        $activo->numero_inventario = $collection[$i][0]? $collection[$i][0] : null;
                        $activo->numero_serial = $collection[$i][1];
                        $activo->nombre = $collection[$i][2];
                        $activo->marca_referencia = $collection[$i][3];
                        $activo->observaciones = $collection[$i][4];
                        $activo->fecha_aceptacion = $collection[1][5]? $collection[1][5] : null;
                        $activo->id_estado = $collection[$i][6]? $collection[$i][6] : null;
                        $activo->id_oficina_ubicacion = $collection[$i][7]? $collection[$i][7] : null;
                        $activo->costo_inicial = $collection[$i][8]? $collection[$i][8] : null;
                        $activo->ultima_revision_estado =  $collection[$i][9]? $collection[$i][9] : null;
                        $activo->id_funcionario_responsable = $collection[$i][10]? $collection[$i][10] : null;
                        $activo->id_usuario = $collection[$i][11]? $collection[$i][11] : null;
                        $activo->funciona_correctamente =  $collection[$i][12]? $collection[$i][12] : 1;
                        $activo->datos_contacto_proveedor = $collection[$i][13];
                        $activo->fecha_fin_garantia = $collection[$i][14]? $collection[$i][14] : null;
                        $activo->numero_factura = $collection[$i][15];
                        $activo->ultimo_mantenimiento = $collection[$i][16]? $collection[$i][16] : null;
                        $activo->cada_cuantos_dias_mantenimiento  = $collection[$i][17]? $collection[$i][17] : null;
                        $activo->es_computador = $collection[$i][18];
                        $activo->save();
                        
                        //Si es un computador, guardamos las propiedades del computador
                        if ($collection[$i][18] == 1) {
                            $propiedades_computador = new Propiedades_computador();
                            $propiedades_computador->id_activo = $cantidadActivos;
                            $propiedades_computador->nombre_equipo = $collection[$i][19]? $collection[$i][19] : null;
                            $propiedades_computador->tipo_escritorio_portatil = $collection[$i][20];
                            $propiedades_computador->MACaddress = $collection[$i][21]? $collection[$i][21] : null;
                            $propiedades_computador->IPaddress = $collection[$i][22]? $collection[$i][22]: null;
                            $propiedades_computador->ip_puerta_enlace = $collection[$i][23];
                            $propiedades_computador->capacidad_ram = $collection[$i][24] ? $collection[$i][24] : null;
                            $propiedades_computador->capacidad_almacenamiento = $collection[$i][25]? $collection[$i][25] : null;
                            $propiedades_computador->cantidad_tarjeta_red_inalambrica = $collection[$i][26]? $collection[$i][26] : null;
                            $propiedades_computador->cantidad_tarjeta_red_alambrica = $collection[$i][27]? $collection[$i][27] : null;
                            $propiedades_computador->save();
                        }

                        if($collection[$i][28] == "" || $collection[$i][28] == null)
                            throw new Error("debes indicar si es un activo compuesto o el id del activo al que compone, en la fila: " . ($i+1));

                        if($collection[$i][28] != "COMPUESTO"){
                            $activo_compuesto = Inventario::where("numero_inventario", $collection[$i][28])
                                    ->orWhere("numero_serial", $collection[$i][28])->first();

                            if($activo_compuesto == null)
                            throw new Error("No se encuentra el compuesto con número de inventario ó serial: " . $collection[$i][28] . " para el componente de la fila " . ($i+1) );

                            $composicionActivo = new ComposicionActivos();
                            $composicionActivo->id_activo_compuesto = $activo_compuesto->id;
                            $composicionActivo->id_activo_componente = $cantidadActivos;
                            $composicionActivo->save();
                        }
                    }

                } catch (Error $ex) {

                    dd('Error al insertar el activo de la fila ' . ($i+1) . " " . $ex->getMessage());
                }
            
                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Se cargaron los " . ($i-1) .  " activos con éxito');
                    window.location.href='/';
                    </script>");            
                

            }

        });

    }

    public function actualizarActivo(Request $request) {

        //Se registra la actualización y se crea un registro en la tabla movimientos con su respectiva descripción.
        $activo = Inventario::find($request->get("id_activo"));
        if (null == $activo) {
            return Response::json("No se encuentra ningun activo con id: " . $request->get("id"));
            die();
        }

        //Solo el responsable del activo con perfil ADMINISTRADOR pueden modificarlo y el usuario ROOT
        if (!$this->usersController->esRoot(Auth::id()))
            if ($activo->id_funcionario_responsable != Auth::id() || !$this->usersController->esAdministrador(Auth::id())) {
                return Response::json("No eres el responsable de este activo. RESPONSABLE DEL ACTIVO: " . $this->usersController->getNombreUsuario($activo->id_funcionario_responsable));
            }

        $cambiosAregistrar = "";

        if ($request->get("numero_inventario") != null && $activo->numero_inventario != $request->get("numero_inventario")) {
            $cambiosAregistrar .= "*Cambio en número_inventario\nAntes: " . $activo->numero_inventario . "\nDepués: " . $request->get("numero_inventario");
            $activo->numero_inventario = $request->get("numero_inventario");
        }
        if ($request->get("serial") != null && $activo->numero_serial != $request->get("serial")) {
            $cambiosAregistrar .= "\n*Cambio en serial\nAntes: " . $activo->numero_serial . "\nDepués: " . $request->get("serial");
            $activo->numero_serial = $request->get("serial");
        }
        if ($request->get("nombre") != null && $activo->nombre != $request->get("nombre")) {
            $cambiosAregistrar .= "\n*Cambio en nombre\nAntes: " . $activo->nombre . "\nDepués: " . $request->get("nombre");
            $activo->nombre = $request->get("nombre");
        }
        if ($request->get("maraca") != null && $activo->marca_referencia != $request->get("maraca")) {
            $cambiosAregistrar .= "\n*Cambio en Marca\nAntes: " . $activo->marca_referencia . "\nDepués: " . $request->get("maraca");
            $activo->marca_referencia = $request->get("maraca");
        }
        $observacion_antigua = $activo->observaciones;
        if ($request->get("observaciones") != null && $activo->observaciones != $request->get("observaciones")) {
            $cambiosAregistrar .= "\n*Cambio en Observaciones\nAntes: " . $activo->observaciones . "\nDepués: " . $request->get("observaciones");
            $activo->observaciones = $request->get("observaciones");
        }
        if ($request->get("fecha_aceptacion") != null && $activo->fecha_aceptacion != $request->get("fecha_aceptacion")) {
            $cambiosAregistrar .= "\n*Cambio en Fecha_aceptación\nAntes: " . $activo->fecha_aceptacion . "\nDepués: " . $request->get("fecha_aceptacion");
            $activo->fecha_aceptacion = $request->get("fecha_aceptacion");
        }
        if ($request->get("estado") != null && $request->get("estado") != "null" && $activo->id_estado != $request->get("estado")) {

            $cambiosAregistrar .= "\n*Cambio en estado\nAntes: " . $this->estadosActivosController->getNombreEstadoDeActivo($activo->id_estado) . "\nDepués: " . $this->estadosActivosController->getNombreEstadoDeActivo($request->get("estado"));
            $activo->id_estado = $request->get("estado");
        }
        if ($request->get("oficina") != null && $request->get("oficina") != 'null' && $activo->id_oficina_ubicacion != $request->get("oficina")) {

            $cambiosAregistrar .= "\n*Cambio en Oficina\nAntes: " . $this->oficinasController->getNombreOficina($activo->id_oficina_ubicacion) . "\nDepués: " . $this->oficinasController->getNombreOficina($request->get("oficina"));
            $activo->id_oficina_ubicacion = $request->get("oficina");
        }
        if ($request->get("costo_inicial") != null && $activo->costo_inicial != $request->get("costo_inicial")) {

            $cambiosAregistrar .= "\n*Cambio en costo_inicial\nAntes: " . $activo->costo_inicial . "\nDepués: " . $request->get("costo_inicial");
            $activo->costo_inicial = $request->get("costo_inicial");
        }
        if ($request->get("fecha_ultima_revision") != null && $activo->ultima_revision_estado != $request->get("fecha_ultima_revision")) {

            $cambiosAregistrar .= "\n*Cambio en fecha_ultima_revisión\nAntes: " . $activo->ultima_revision_estado . "\nDepués: " . $request->get("fecha_ultima_revision");
            $activo->ultima_revision_estado = $request->get("fecha_ultima_revision");
        }

        if ($request->get("id_responsable") != null && $request->get("id_responsable") != 'null' && $activo->id_funcionario_responsable != $request->get("id_responsable")) {

            $cambiosAregistrar .= "\n*Cambio en responsable del activo\nAntes: " . $this->usersController->getNombreUsuario($activo->id_funcionario_responsable) . "\nDepués: " . $this->usersController->getNombreUsuario($request->get("id_responsable"));
            $activo->id_funcionario_responsable = $request->get("id_responsable");
        }
        if ($request->get("id_usuario") != null && $request->get("id_usuario") != 'null' && $activo->id_usuario != $request->get("id_usuario")) {

            $cambiosAregistrar .= "\n*Cambio en usuario\nAntes: " . $this->usersController->getNombreUsuario($activo->id_usuario) . "\nDepués: " . $this->usersController->getNombreUsuario($request->get("id_usuario"));
            $activo->id_usuario = $request->get("id_usuario");
        }
        if ($request->get("funciona_correctamente") != null && $activo->funciona_correctamente != $request->get("funciona_correctamente")) {

            $cambiosAregistrar .= "\n*Cambio en funciona_correctamente\nAntes: " . $activo->funciona_correctamente . "\nDepués: " . $request->get("funciona_correctamente");
            $activo->funciona_correctamente = $request->get("funciona_correctamente");
        }
        if ($request->get("datos_proveedor") != null && $activo->datos_contacto_proveedor != $request->get("datos_proveedor")) {

            $cambiosAregistrar .= "\n*Cambio en datos_proveedor\nAntes: " . $activo->datos_contacto_proveedor . "\nDepués: " . $request->get("datos_proveedor");
            $activo->datos_contacto_proveedor = $request->get("datos_proveedor");
        }
        if ($request->get("fin_garantia") != null && $activo->fecha_fin_garantia != $request->get("fin_garantia")) {

            $cambiosAregistrar .= "\n*Cambio en fecha fin garantía\nAntes: " . $activo->fecha_fin_garantia . "\nDepués: " . $request->get("fin_garantia");
            $activo->fecha_fin_garantia = $request->get("fin_garantia");
        }
        if ($request->get("numero_factura") != null && $activo->numero_factura != $request->get("numero_factura")) {

            $cambiosAregistrar .= "\n*Cambio en número de factura\nAntes: " . $activo->numero_factura . "\nDepués: " . $request->get("numero_factura");
            $activo->numero_factura = $request->get("numero_factura");
        }
        
        if ($request->get("ultimo_mantenimiento") != null && $activo->ultimo_mantenimiento != $request->get("ultimo_mantenimiento")) {

            $cambiosAregistrar .= "\n*Cambio en fecha de último movimiento\nAntes: " . $activo->ultimo_mantenimiento . "\nDepués: " . $request->get("ultimo_mantenimiento");
            $activo->ultimo_mantenimiento = $request->get("ultimo_mantenimiento");
        }
        
        if ($request->get("cada_cuantos_dias_mantenimiento") != null && $activo->cada_cuantos_dias_mantenimiento != $request->get("cada_cuantos_dias_mantenimiento")) {

            $cambiosAregistrar .= "\n*Cambio en periodo de mantenimientos\nAntes: " . $activo->cada_cuantos_dias_mantenimiento . "\nDepués: " . $request->get("cada_cuantos_dias_mantenimiento");
            $activo->cada_cuantos_dias_mantenimiento = $request->get("cada_cuantos_dias_mantenimiento");
        }          
        
        if ($request->get("es_computador") != null && $activo->es_computador != $request->get("es_computador")) {

            $cambiosAregistrar .= "\n*Cambio en ¿es computador?\nAntes: " . $activo->es_computador . "\nDepués: " . $request->get("es_computador");
            $activo->es_computador = $request->get("es_computador");
        }
        $activo->save();

        if ($request->get("es_computador") == 1) {

            $propiedades_computador = Propiedades_computador::find($request->get("id_activo"));

            if ($request->get("nombre_computador") != "null" && $request->get("nombre_computador") != null && $propiedades_computador->nombre_equipo != $request->get("nombre_computador")) {

                $cambiosAregistrar .= "\n*Cambió el nombre_equipo\nAntes: " . $propiedades_computador->nombre_equipo . "\nDepués: " . $request->get("nombre_computador");
                $propiedades_computador->nombre_equipo = $request->get("nombre_computador");
            }

            if ($request->get("tipo_escritorio_portatil") != '' && $propiedades_computador->tipo_escritorio_portatil != $request->get("tipo_escritorio_portatil")) {
                $cambiosAregistrar .= "\n*Cambió el tipo de computador\nAntes: " . $propiedades_computador->tipo_escritorio_portatil . "\nDepués: " . $request->get("tipo_escritorio_portatil");
                $propiedades_computador->tipo_escritorio_portatil = $request->get("tipo_escritorio_portatil");
            }
            if ($request->get("mac") != "null" && $request->get("mac") != null && $propiedades_computador->MACaddress != $request->get("mac")) {

                $cambiosAregistrar .= "\n*Cambió la MAC\nAntes: " . $propiedades_computador->MACaddress . "\nDepués: " . $request->get("mac");
                $propiedades_computador->MACaddress = $request->get("mac");
            }

            if ($request->get("ip") != "null" &&  $request->get("ip") != null && $propiedades_computador->IPaddress != $request->get("ip")) {

                $cambiosAregistrar .= "\n*Cambió la IP\nAntes: " . $propiedades_computador->IPaddress . "\nDepués: " . $request->get("ip");
                $propiedades_computador->IPaddress = $request->get("ip");
            }

            if ($request->get("ip_gateway") != null && $propiedades_computador->ip_puerta_enlace != $request->get("ip_gateway")) {

                $cambiosAregistrar .= "\n*Cambió el ip_gateway\nAntes: " . $propiedades_computador->ip_puerta_enlace . "\nDepués: " . $request->get("ip_gateway");
                $propiedades_computador->ip_puerta_enlace = $request->get("ip_gateway");
            }

            if ($request->get("capacidad_ram") != "null" && $request->get("capacidad_ram") != null && $propiedades_computador->capacidad_ram != $request->get("capacidad_ram")) {
                $cambiosAregistrar .= "\n*Cambió la cantidad de RAM\nAntes: " . $propiedades_computador->capacidad_ram . "\nDepués: " . $request->get("capacidad_ram");
                $propiedades_computador->capacidad_ram = $request->get("capacidad_ram")?  $request->get("capacidad_ram") : 0;
            }
            if ($request->get("capacidad_almacenamiento") != "null" && $request->get("capacidad_almacenamiento") != null && $propiedades_computador->capacidad_almacenamiento != $request->get("capacidad_almacenamiento")) {
                $cambiosAregistrar .= "\n*Cambió la capacidad de almacenamiento\nAntes: " . $propiedades_computador->capacidad_almacenamiento . "\nDepués: " . $request->get("capacidad_almacenamiento");
                $propiedades_computador->capacidad_almacenamiento = $request->get("capacidad_almacenamiento")? $request->get("capacidad_almacenamiento") : 0 ;
            }
            if ($request->get("cantidad_tarjeta_red_inalambrica") != "null" && $request->get("cantidad_tarjeta_red_inalambrica") != null && $propiedades_computador->cantidad_tarjeta_red_inalambrica != $request->get("cantidad_tarjeta_red_inalambrica")) {
                $cambiosAregistrar .= "\n*Cambió el número de NIC inalambricas\nAntes: " . $propiedades_computador->cantidad_tarjeta_red_inalambrica . "\nDepués: " . $request->get("cantidad_tarjeta_red_inalambrica");
                $propiedades_computador->cantidad_tarjeta_red_inalambrica = $request->get("cantidad_tarjeta_red_inalambrica")? $request->get("cantidad_tarjeta_red_inalambrica"): 0;
            }

            if ($request->get("cantidad_tarjeta_red_alambrica") != "null" &&  $request->get("cantidad_tarjeta_red_alambrica") != null && $propiedades_computador->cantidad_tarjeta_red_alambrica != $request->get("cantidad_tarjeta_red_alambrica")) {
                $cambiosAregistrar .= "\n*Cambió el número de NIC alambricas\nAntes: " . $propiedades_computador->cantidad_tarjeta_red_alambrica . "\nDepués: " . $request->get("cantidad_tarjeta_red_alambrica");
                $propiedades_computador->cantidad_tarjeta_red_alambrica = $request->get("cantidad_tarjeta_red_alambrica")? $request->get("cantidad_tarjeta_red_alambrica") : 0;
            }
            $propiedades_computador->save();


        }
        
        if($cambiosAregistrar == ""){
            return "No realizaste ningún cambio";
        }

        $movimiento = new Movimientos;
        $movimiento->id_activo = $request->get("id_activo");
        $movimiento->idUsuarioSolicito = $request->get("id_usuario_solicito");
        $movimiento->observaciones = $cambiosAregistrar;
        $movimiento->yaDevuelto = null;
        $movimiento->save();
        
        return "Cambios guardados con éxito";
    }

    public function anexar_archivo(Request $request){
        
        //Validamos que solo el responsable suba los anexos
        $respuesta = Inventario::where( "id_funcionario_responsable", Auth::id() )->where("id", $request->get("id_activo"))->get();  
        if(!$this->usersController->esRoot(Auth::id()) && sizeof($respuesta) <= 0){
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('NO PUEDES ANEXAR INFORMACIÓN A ESTE ACTIVO, PORQUE NO ERES EL RESPONSABLE DEL ACTIVO');
                window.location.href='/home';
                </script>");      
            die();
        }
        
        
        $id_activo_anexar = $request->get("id_activo");
        $nombre_archivo_anexar = $_FILES['archivo']['name'];
        $reemplazarArchivoConElMismoNombre = $request->get("reemplazar_archivo");
        
        if(null == $id_activo_anexar || null == $nombre_archivo_anexar){
            
         echo ("<script LANGUAGE='JavaScript'>
            window.alert('NO SELECCIONASTE NINGÚN ARCHIVO');
            window.location.href='/home';
            </script>");           
            
        }
        
        if("REEMPLAZAR_ARCHIVO" !== $reemplazarArchivoConElMismoNombre && $this->yaHabiaSubidoUnArchivoConEsteNombre($id_activo_anexar, $nombre_archivo_anexar) ){
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('YA HABÍAS SUBIDO UN ARCHÍVO CON ESTE NOMBRE, CAMBIA EL NOMBRE O SELECCIONA LA OPCIÓN REEMPLAZAR ARCHIVO CON EL MISMO NOMBRE');
                window.location.href='/home';
                </script>");
        }
        
        $url = request()->archivo->storeAs( "/".$id_activo_anexar, request()->archivo->getClientOriginalName());
        
        if( $this->yaHabiaSubidoUnArchivoConEsteNombre($id_activo_anexar, $nombre_archivo_anexar) == "REEMPLAZAR_ARCHIVO"){
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('SE REEMPLAZÓ EL ARCHIVO CON ÉXITO');
                window.location.href='/home';
                </script>");            
        }else{
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('SE GUARDÓ CON ÉXITO');
                window.location.href='/home';
                </script>");            
        }
        

    }
    
    private function yaHabiaSubidoUnArchivoConEsteNombre($id_activo, $nombreArchivo){
        return Storage::disk('local')->has($id_activo . "/" . $nombreArchivo);
    }
    
    public function listar_anexos(Request $request){
        
        $anexos = Storage::files( $request->get("id_activo"));
        $anexos_respuesta = [];
        
        foreach ($anexos as $anexo) {
            
            array_push($anexos_respuesta, [basename($anexo), "/" . $anexo]);
            
        }
        
        return $anexos_respuesta;
        
    }
    
    public function getAnexo($id_activo , $ruta_anexo){
        $ruta = $id_activo . "/" . $ruta_anexo;
        
        //Validamos que solo el responsable descargue los anexos
        $respuesta = Inventario::where( "id_funcionario_responsable", Auth::id() )->where("id", $id_activo)->get();  
        if($this->usersController->esRoot(Auth::id()) || sizeof($respuesta) > 0)
            return Storage::download($ruta);
        else
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('NO ERES RESPONSABLE DE DICHO ACTIVO, NO PUEDES DESCARGAR SUS ANEXOS');
                window.location.href='/home';
                </script>"); 
    }
    
    public function getNombreActivo($id_activo) {

        $activo = Inventario::find($id_activo);
        return $activo->nombre;
    }

    public function getNumeroInventario($id_activo) {
        $activo = Inventario::find($id_activo);
        return $activo->numero_inventario;
    }

    public function getInventario_arreglo_llave_valor() {

        $arreglo = array();
        $respuesta = null;

        if ($this->usersController->esRoot(Auth::id()))
            $respuesta = Inventario::all(["nombre", "numero_inventario", "id"]);
        else
            $respuesta = Inventario::where("id_funcionario_responsable", Auth::id())->get(["nombre", "numero_inventario", "id"]);

        foreach ($respuesta as $r) {

            array_push($arreglo, [$r->id, $r->numero_inventario . "-" . $r->nombre]);
        }

        return response()->json($arreglo);
    }

    public function getActivosRequierenMantenimiento(){
        
        $now = new \DateTime();
        $now = $now->format('Y-m-d');
        
        $activosRequierenMantenimiento = Inventario::whereRaw('DATEDIFF(?,ultimo_mantenimiento) >= (select cada_cuantos_dias_mantenimiento where id = id  && cada_cuantos_dias_mantenimiento != 0)')
            ->setBindings([$now])->get();
        
        return $activosRequierenMantenimiento;
        
    }
    
    public function getComponentes_CompuestoDe_DeActivo(Request $request){
        $componentes = ComposicionActivos::where("id_activo_compuesto", $request->get("id_activo") )->get(["id_activo_componente"]);

        $compuestoDe = ComposicionActivos::where("id_activo_componente", $request->get("id_activo") )->first(["id_activo_compuesto"]);


        $result = [];

        array_push($result, Inventario::whereIn("id", $componentes)->get());

        if($compuestoDe != null)
            array_push($result, Inventario::where("id", $compuestoDe->id_activo_compuesto)->first() );
        else
            array_push($result, null );

        return $result;
          
    }

    public function eliminarComponenteDeActivo($id_activo, $id_componente){
        ComposicionActivos::where("id_activo_compuesto", $id_activo)
        ->where("id_activo_componente", $id_componente)->delete();
        

        $movimiento = new Movimientos;
        $movimiento->id_activo = $id_activo;
        //TODO: no se puede usar Auth::id() porque no se le está aplicando el middleware jwt.auth:
        $movimiento->idUsuarioSolicito = 0;
        $movimiento->observaciones = "Se le quitó el componente con id: " . $id_componente;
        $movimiento->yaDevuelto = null;
        $movimiento->save();

        $movimiento = new Movimientos;
        $movimiento->id_activo = $id_componente;
        //TODO: no se puede usar Auth::id() porque no se le está aplicando el middleware jwt.auth:
        $movimiento->idUsuarioSolicito = 0;
        $movimiento->observaciones = "Ya no es más un componente del activo con id: " . $id_activo;
        $movimiento->yaDevuelto = null;
        $movimiento->save();

        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Se eliminó el componente con éxito');
        window.location.href='/#/inventario';
        </script>");  
    }

    public function agregarComponente(Request $request){
        $idActivosCompuestos = $request->get("idActivosComponentes");
        $idActivoCompuesto  =  $request->get("id_activo");


        $data = [];
        $infoComponentesAgregados = "";
        foreach($idActivosCompuestos as $id){

            if($id == $idActivoCompuesto){
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Un activo no puede ser componente de él mismo');
                window.location.href='/#/inventario';
                </script>");  
                die();
            }

            $infoComponentesAgregados .= $id . ", ";

            array_push($data, ["id_activo_compuesto" => $idActivoCompuesto, "id_activo_componente" => $id]);

            $movimiento = new Movimientos;
            $movimiento->id_activo = $id;
            //TODO: no se puede usar Auth::id() porque no se le está aplicando el middleware jwt.auth:
            $movimiento->idUsuarioSolicito = 0;
            $movimiento->observaciones = "Ahora es un componente del activo con id: " . $idActivoCompuesto;
            $movimiento->yaDevuelto = null;
            $movimiento->save();
        }

        ComposicionActivos::insert($data);

        $movimiento = new Movimientos;
        $movimiento->id_activo = $request->get("id_activo");
        //TODO: no se puede usar Auth::id() porque no se le está aplicando el middleware jwt.auth:
        $movimiento->idUsuarioSolicito = 0;
        $movimiento->observaciones = "Se le agregaron los componentes  con id: " . $infoComponentesAgregados ;
        $movimiento->yaDevuelto = null;
        $movimiento->save();

        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Se cargaron los " . sizeof($data) .  " componentes al activo');
        window.location.href='/#/inventario';
        </script>");  
    }
    
}
