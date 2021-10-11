<?php

namespace App\Http\Controllers\api; 

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


//Cualquier clase que extienda de ésta, podrá obtener al usuario
//logueado utilizando el método authUser().
class Controller extends BaseController
{

    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    public function __construct()
    {
        auth()->setDefaultDriver("api");
    }


    public function authUser(){

        try{
            $user = auth()->userOrFail();
        }catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error' => $e->getMessage()]);
        } 
        
        return $user;
    
    }    
    
}
