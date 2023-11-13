<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class shopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'こってり屋',
                'address' => '東京都あきる野市1-1-1',
                'inquiry' => '042-000-0000',
                'information' => '独自の製法で仕上げた自慢のスープ。麺も自家製にこだわっており、オリジナリティ抜群！',
                'filename' => ''
            ],
            [
                'owner_id' => 2,
                'name' => ' あっさり屋',
                'address' => '東京都昭島市1-1-1',
                'inquiry' => '042-000-0000',
                'information' => '独自の製法で仕上げた自慢のスープ。麺も自家製にこだわっており、オリジナリティ抜群！',
                'filename' => ''
            ],
        ]);
    }
}