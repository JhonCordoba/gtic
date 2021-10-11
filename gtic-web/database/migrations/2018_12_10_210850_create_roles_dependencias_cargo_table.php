<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesDependenciasCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_dependencias_cargo', function (Blueprint $table) {
            
            $table->integer('id_usuario');
            $table->integer('id_dependencia');
            $table->integer('id_rol');
            $table->integer('id_cargo');

            $table->timestamps();
            
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_dependencia')->references('id')->on('dependencias_empresa');
            $table->foreign('id_rol')->references('id')->on('roles_del_sistema');
            $table->foreign('id_cargo')->references('id')->on('cargos_de_la_empresa');

            
            $table->primary(["id_usuario", "id_dependencia", "id_rol", "id_cargo"], "PK_roles_dependencias_cargo");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_dependencias_cargo');
    }
}
