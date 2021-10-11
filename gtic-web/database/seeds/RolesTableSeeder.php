<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_del_sistema')->insert([
            'id' => "0",
            'nombre' => "ROOT",
            'descripcion' => "Rol con todos los privilegios",
        ]);
        
        DB::table('roles_del_sistema')->insert([
            'id' => "1",
            'nombre' => "ADMINISTRADOR",
            'descripcion' => "Rol que puede modificar información de los activos de los que es responsable",
        ]);
        
        DB::table('roles_del_sistema')->insert([
            'id' => "2",
            'nombre' => "USUARIO",
            'descripcion' => "Rol más básico, recibe prestamos, puede ver informes, activos de los que es responsable...",
        ]);           
        
        DB::table('dependencias_empresa')->insert([
            'id' => "0",
            'nombre' => "Gestión Tecnológica",
            'descripcion' => "Área encargada de gestionar los recursos tecnológicos y más",
        ]);   
        
        DB::table('cargos_de_la_empresa')->insert([
            'id' => "0",
            'nombre' => "Administrador del SGT",
            'descripcion' => "Encargado de administrar todo el sistema de gestión tecnológica",
        ]);   

        DB::table('roles_dependencias_cargo')->insert([
            'id_usuario' => "0",
            'id_dependencia' => "0",
            'id_rol' => "0",
            'id_cargo' => "0",
        ]);         
        
        DB::table('info_usuarios')->insert([
            'id' => "0",
            'id_usuario' => "0",
            'telefono' => "0",
            'ciudad' => "0",
            'cedula' => "0"
        ]);   
        
    }
}
