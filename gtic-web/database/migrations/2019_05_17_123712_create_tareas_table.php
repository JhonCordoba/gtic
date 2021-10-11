<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->integer('id');
            $table->integer("id_tipo_tarea");
            $table->integer("id_usuario");
            $table->integer("id_usaurio_asigno");
            $table->string("titulo");
            $table->string("descripcion")->nullable();
            $table->double("tiempo_requerido_minutos")->nullable();
            $table->boolean("finalizada");
            
            
            
            $table->timestamps();
            
            $table->primary("id");
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_usaurio_asigno')->references('id')->on('users');   
            $table->foreign('id_tipo_tarea')->references('id')->on('tipo_tareas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
