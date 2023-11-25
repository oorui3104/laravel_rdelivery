<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => Hash::make('password123'),
            'postcode' => '194-0000',
            'address' => '神奈川県横浜市1-1-11'
            ],
            [
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => Hash::make('password123'),
            'postcode' => '195-0000',
            'address' => '神奈川県相模原市1-1-11'
            ]            
        ]);
    }
}
