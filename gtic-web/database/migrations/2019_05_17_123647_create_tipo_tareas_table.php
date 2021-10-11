<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_tareas', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('id_usuario');
            $table->string("nombre");
            $table->string("descripcion")->nullable();
            $table->timestamps();
            
            $table->primary("id");
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_tareas');
    }
}
