<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropiedadesComputadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedades_computador', function (Blueprint $table) {
            
            $table->integer('id_activo');
            $table->string('nombre_equipo')->unique();
            $table->string('tipo_escritorio_portatil');
            $table->string('MACaddress')->nullable()->unique();
            $table->string('IPaddress')->nullable()->unique();
            $table->string('ip_puerta_enlace')->nullable();
            $table->double('capacidad_ram');
            $table->double('capacidad_almacenamiento');
            $table->integer('cantidad_tarjeta_red_inalambrica');
            $table->integer('cantidad_tarjeta_red_alambrica');
            
            $table->timestamps();
            
            $table->primary('id_activo');
            $table->foreign('id_activo')->references('id')->on('activos');
            $table->foreign('tipo_escritorio_portatil')->references('nombre')->on('tipo_computadoras');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propiedades_computador');
    }
}
