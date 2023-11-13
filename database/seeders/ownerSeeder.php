<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ownerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => Hash::make('password123'),
            ],
            [
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => Hash::make('password123'),
            ]            
        ]);
    }
}

