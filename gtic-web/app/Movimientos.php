<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    protected $table = 'movimientos';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id_activo',
        'idUsuarioSolicito',
        'observaciones',
        'recibido',
        'yaDevuelto',
        'created_at',
        'updated_at'
    ];

    public function activo()
    {
    	return $this->belongsTo('App\Inventario', 'id_activo');
    }    
}
