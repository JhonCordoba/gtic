<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Dependencias;
use App\Cargos;
use App\Roles;
use App\InfoUsuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller {
    
    const ROOT = 0;
    const ADMINISTRADOR = 1;
    const USUARIO_BASICO = 2;
    

    public function getNombreUsuario($id_usuario) {

        $usuario = User::find($id_usuario);

        if ($usuario == null) {
            return "---";
        } else {
            return $usuario->name;
        }
    }

    private function getRoles_dependencias_cargo($id_usuario) {

        $resultado = DB::table('roles_dependencias_cargo')
                        ->select('id_dependencia', 'id_rol', 'id_cargo')
                        ->where('id_usuario', $id_usuario)->get()->toArray();

        for ($i = 0; $i < sizeof($resultado); $i++) {

            $resultado[$i]->nombreDependencia = Dependencias::find($resultado[$i]->id_dependencia)->nombre;
            $resultado[$i]->nombreRol = Roles::find($resultado[$i]->id_rol)->nombre;
            $resultado[$i]->nombreCargo = Cargos::find($resultado[$i]->id_cargo)->nombre;
        }

        return $resultado;
    }

    public function getRoles_arreglo_llave_valor(){
        
        //Obtenemos todos los roles, excepto al ROOT, para evitar que crean usuario ROOT.
        $respuesta =   Roles::where("id", "!=", 0)->get(["nombre", "id", "descripcion"]);
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->nombre]);

        }
            
        return response()->json( $arreglo );
    }
    
    public function getUsuariosConSuInformacion() {

        $usauriosObjetos = User::all();
        $usuariosArray = array();
        for ($i = 0; $i < sizeof($usauriosObjetos); $i++) {

            $roles_dependencias_cargos = $this->getRoles_dependencias_cargo($usauriosObjetos[$i]->id);


            //Por cada perfil de un usuario se inserta un registro distinto
            foreach ($roles_dependencias_cargos as $r) {

                array_push($usuariosArray, [$usauriosObjetos[$i]->id, $usauriosObjetos[$i]->name,  $usauriosObjetos[$i]->email, $r->nombreDependencia . "-" . $r->id_dependencia, $r->nombreRol . "-" . $r->id_rol, $r->nombreCargo . "-" . $r->id_cargo]);
            }
        }
        

        //y por cada registro se guarda allí su respectiva información:
        for ($i = 0; $i < sizeof($usuariosArray); $i++ ) {

            $masInfoUsuario = InfoUsuarios::find($usuariosArray[$i][0]);
            if(isset( $masInfoUsuario ) )
                $usuariosArray[$i] = array_merge($usuariosArray[$i], [$masInfoUsuario->telefono, $masInfoUsuario->ciudad, $masInfoUsuario->cedula]);
        }

        return $usuariosArray;
    }

    public function personas_arreglo_llave_valor(){
        
        $respuesta =   User::all(["name", "id"]);
        
        $arreglo = array();
        foreach ($respuesta as $r) {
            
            array_push($arreglo, [$r->id, $r->name]);

        }
            
        return response()->json( $arreglo );
    }    
    
    public function addUsuariosConSuInformacion(Request $request){

        //Evitamos que creen usuarios tipo ROOT
        if($request->post("rol") == 0)
            return "No se pueden crear usuarios con el rol ROOT";
        
        $cantidadPersonas = User::all()->count();
        
        $id = $cantidadPersonas++;
        
        $persona = new User;
        $persona->id = $id;
        $persona->name = $request->post("name");
        $persona->email = $request->post("email");
        $persona->password =  Hash::make("1234");
        $persona->save();
        
        $infoUsuario = new InfoUsuarios;
        $infoUsuario->id_usuario = $id;
        $infoUsuario->telefono = $request->post("celular");
        $infoUsuario->ciudad = $request->post("direccion");
        $infoUsuario->cedula = $request->post("cedula");
        $infoUsuario->save();
        
        
        DB::table('roles_dependencias_cargo')->insert([
            ['id_usuario' => $id, 'id_dependencia' => $request->post("dependencia"), 'id_rol' => $request->post("rol"), 'id_cargo' => $request->post("cargo")]
        ]);        
        
    }

    public function getHashPassword($id_persona){
        
        return User::find($id_persona)->password;
        
    }
    
    public function esRoot($id_persona){
        
        $resultado = $this->getRoles_dependencias_cargo($id_persona);
        
        for ($i = 0; $i < sizeof($resultado); $i++) {
            if($resultado[$i]->id_rol === UsersController::ROOT)
                return true;
        }
        
        return false;
        
    }
  
    public function esAdministrador($id_persona){
        
        $resultado = $this->getRoles_dependencias_cargo($id_persona);
        
        for ($i = 0; $i < sizeof($resultado); $i++) {
            if($resultado[$i]->id_rol == UsersController::ADMINISTRADOR)
                return true;
        }
        
        return false;        
        
    }    
    
    
    public function esUsuarioBasico($id_persona){
       
        $resultado = $this->getRoles_dependencias_cargo($id_persona);
        
        for ($i = 0; $i < sizeof($resultado); $i++) {
            if($resultado[$i]->id_rol == UsersController::USUARIO_BASICO)
                return true;
        }
        
        return false;            
        
    }   
    
    public function yaCambioElPassword($id_persona){
        
        //Si son iguales es porque no la ha cambiado por eso la negación !
        return !Hash::check("1234", $this->getHashPassword($id_persona));
        
    }
    
    public function cambiar_password(Request $request){
        
        if($request->post("new_password") == "1234"){
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Espero que sea una broma');
                window.location.href='/home';
                </script>");
            die();
            return;
        }
        
        if( $request->post("old_password") != $request->post("new_password") ){
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Las contraseñas no coinciden');
                window.location.href='/home';
                </script>");
            die();
            return;
        }else{
            
           $user = User::find( Auth::id() );
           $user->password =  Hash::make( $request->post("new_password") );
           $user->save();
           
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Cambios guardados');
                window.location.href='/home';
                </script>");           
        }
        
    }
    
    public function actualizarUsuario(Request $request){
        //Solo el usuario root puede actualizar esto
        if (!$this->esRoot(Auth::id())) {
            return Response::json( ["mensaje" => "Para realizar esta acción contacta al Área de Gestión de Recursos Tecnológicos"] );
        }   
        
        $persona = User::find($request->get("id_persona"));
        if (null == $persona) {
            return Response::json("No se encuentra a ninguna persona con id: " . $request->get("id"));
            die();
        }        
        
        if ($request->get("name") != null && $request->get("name") != "" && $persona->name != $request->get("name")) {
            $persona->name = $request->get("name");
        }      
        
        if ($request->get("password") != null && $request->get("password") != "" &&  $persona->password != $request->get("password")) {
            $persona->password = Hash::make( $request->get("password") );
        }   
        $persona->save();
        return;
    }

    public function check_change_password($id_persona){

        return Response::json(  !Hash::check("1234", $this->getHashPassword($id_persona))  );

    }
    
}
