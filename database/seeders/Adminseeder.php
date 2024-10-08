<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

use Illuminate\Support\Facades\Hash; 

use Illuminate\Support\Str;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([    

         'name' => 'admin',  

         'email' => 'admin@gmail.com',

         'image' => 'apple.png',   

         'password' => Hash::make('admin123'),   

      ]); 
    }
}
