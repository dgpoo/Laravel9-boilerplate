<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

use Illuminate\Support\Facades\Hash; 

use Illuminate\Support\Str;
class Settingseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([    

         'image' => 'demologo.jpg',  

         'favicon' => 'demofav.png',

         'sitename' => 'demo',    

      ]); 
    }
}
