<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles_dependencias_cargo extends Model
{
    protected $table = "roles_dependencias_cargo";
    protected $primaryKey = ['id_usuario', 'id_dependencia', 'id_rol', 'id_cargo'];

}

