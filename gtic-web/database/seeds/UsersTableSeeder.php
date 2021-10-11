<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'id' => "0",
            'name' => "ROOT",
            'email' => "jhon.figueroa@correounivalle.edu.co",
            'password' => bcrypt('1234'),
        ]);

        
        
    }
}
