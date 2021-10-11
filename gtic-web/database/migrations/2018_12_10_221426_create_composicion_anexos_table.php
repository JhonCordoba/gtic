<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComposicionAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composicion_anexos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_activo");
            $table->string("ruta_archivo");
            
            $table->timestamps();
            
            $table->foreign('id_activo')->references('id')->on('activos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('composicion_anexos');
    }
}
