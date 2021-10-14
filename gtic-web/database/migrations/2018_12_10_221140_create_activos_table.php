<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('activos', function (Blueprint $table) {
            
            $table->integer('id'); //se autoincrementa
            $table->string('numero_inventario')->unique()->nullable(true); //se autoincrementa
            $table->string('numero_serial')->unique()->nullable(true);
            $table->string('nombre');
            $table->string('marca_referencia')->default("")->nullable(true);
            $table->longText('observaciones')->nullable(true);
            $table->date('fecha_aceptacion')->nullable(true);
            $table->integer('id_estado')->nullable(true);
            $table->integer('id_oficina_ubicacion')->nullable(true);
            $table->double('costo_inicial')->default(0)->nullable(true);
            $table->date('ultima_revision_estado')->nullable(true);
            $table->integer('id_funcionario_responsable')->nullable(true);
            $table->integer('id_usuario')->nullable(true);
            $table->boolean('funciona_correctamente')->default(true);
            $table->string('datos_contacto_proveedor')->default("")->nullable(true);
            $table->date('fecha_fin_garantia')->nullable(true);
            $table->string('numero_factura')->default("")->nullable(true);
            $table->boolean('es_computador');
            
            $table->timestamps();
            
            $table->primary('id');
            $table->foreign('id_estado')->references('id')->on('estados_activos');
            $table->foreign('id_oficina_ubicacion')->references('id')->on('oficinas');
            $table->foreign('id_funcionario_responsable')->references('id')->on('users');
            $table->foreign('id_usuario')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('activos');
    }

}
