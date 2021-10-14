<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'activos';
    protected $primaryKey = 'id';



    public function movimientos()
    {
	  	return $this->hasMany('App\Movimientos', 'id_activo');
    }   
    
}
