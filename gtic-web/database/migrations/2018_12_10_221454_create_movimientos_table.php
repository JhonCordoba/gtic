<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_activo');
            $table->integer('idUsuarioSolicito');
            $table->longText('observaciones')->nullable();
            $table->boolean('recibido')->nullable(); //Si es null NO es un prestamo
            $table->boolean('yaDevuelto')->nullable(); //Si es null NO es un prestamo
            $table->timestamps();
            
            
            $table->foreign('id_activo')->references('id')->on('activos');
            $table->foreign('idUsuarioSolicito')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
