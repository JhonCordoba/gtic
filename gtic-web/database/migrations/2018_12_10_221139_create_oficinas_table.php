<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinas', function (Blueprint $table) {
            
            $table->integer('id');
            $table->integer('id_edificio_ubicacion'); 
            $table->string('nombre')->nullable();
            
            $table->timestamps();
            
            $table->primary('id');
            
            $table->foreign('id_edificio_ubicacion')->references('id')->on('edificios');
            

        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oficinas');
    }
}
