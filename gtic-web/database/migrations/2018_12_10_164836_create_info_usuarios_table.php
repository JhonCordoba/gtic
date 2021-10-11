<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_usuarios', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('id_usuario')->unique();
            $table->String('telefono')->nullable();
            $table->String('ciudad')->nullable();
            $table->String('cedula')->nullable();

            $table->timestamps();

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
        Schema::dropIfExists('info_usuarios');
    }
}
