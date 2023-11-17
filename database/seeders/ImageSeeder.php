<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
            'owner_id' => 1,
            'filename' => 'sample01.png',
            ],
            [
            'owner_id' => 1,
            'filename' => 'sample03.jpeg',
            ],
            [
            'owner_id' => 2,
            'filename' => 'sample02.png',
            ],
            [
            'owner_id' => 2,
            'filename' => 'sample04.jpeg',
            ],
                
        ]);
    }
}
