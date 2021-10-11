<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComputadorSoftwareInstaladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computador_software_instalado', function (Blueprint $table) {
            $table->integer("id_computador");
            $table->integer("id_software");
            $table->timestamps();
            
            
            $table->primary(["id_computador", "id_software"], "PK_software_instalado");
            
            $table->foreign('id_computador')->references('id')->on('activos');
            $table->foreign('id_software')->references('id')->on('software');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computador_software_instalado');
    }
}
