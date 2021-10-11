<?php

use Illuminate\Database\Seeder;

class TipoComputadorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_computadoras')->insert([
            'nombre' => "ESCRITORIO",
            'descripcion' => "Computador de escritorio",
        ]);
        
        DB::table('tipo_computadoras')->insert([
            'nombre' => "PORTATIL",
            'descripcion' => "Computdor portátil",
        ]);    
        
        DB::table('tipo_computadoras')->insert([
            'nombre' => "TODOENUNO",
            'descripcion' => "Computador de escritorio todo en uno",
        ]);           

    }
}
