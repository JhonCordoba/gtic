<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCamposMantenimiento extends Migration
{

    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->date('ultimo_mantenimiento')->nullable();
            $table->integer("cada_cuantos_dias_mantenimiento")->nullable();
        });
    }


    public function down()
    {
        //
    }
}
