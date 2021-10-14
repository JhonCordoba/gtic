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
            $table->string('nombre_equipo')->nullable()->unique();
            $table->string('tipo_escritorio_portatil');
            $table->string('MACaddress')->nullable()->unique();
            $table->string('IPaddress')->nullable()->unique();
            $table->string('ip_puerta_enlace')->nullable()->default("");
            $table->double('capacidad_ram')->nullable()->default(0);
            $table->double('capacidad_almacenamiento')->nullable()->default(0);
            $table->integer('cantidad_tarjeta_red_inalambrica')->nullable()->default(0);
            $table->integer('cantidad_tarjeta_red_alambrica')->nullable()->default(1);
            
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
