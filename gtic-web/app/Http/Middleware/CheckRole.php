<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\UsersController;
use Auth;
use Response;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        
        $userController = new UsersController();
        
        switch ($role){
            
            case "root":
                if($userController->esRoot(Auth::id())){
                    return $next($request);
                }else{
                    return Response::json(["mensaje" => "NO ERES USUARIO ROOT PARA REALIZAR ESTA ACCIÓN"]);
                }                
            break;
            
            case "administrador":
                if($userController->esAdministrador(Auth::id())){
                    return $next($request);
                }else{
                    return Response::json(["mensaje" => "NO ERES ADMINISTRADOR PARA REALIZAR ESTA ACCIÓN"]);
                }                    
            break;               
            
            case "usuario":
                if($userController->esUsuarioBasico(Auth::id())){
                    return $next($request);
                }else{
                    return Response::json(["mensaje" => "NO ERES USUARIO BÁSICO PARA REALIZAR ESTA ACCIÓN"]);
                }                    
            break;
                     
        }
    }
}
