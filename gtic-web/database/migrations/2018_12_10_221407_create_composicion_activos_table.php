<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComposicionActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composicion_activos', function (Blueprint $table) {

            $table->integer('id_activo_compuesto');
            $table->integer('id_activo_componente');
            
            $table->primary(['id_activo_compuesto', 'id_activo_componente'], "PK_composicion_activos");
            
            $table->foreign('id_activo_compuesto')->references('id')->on('activos');
            $table->foreign('id_activo_componente')->references('id')->on('activos');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('composicion_activos');
    }
}
