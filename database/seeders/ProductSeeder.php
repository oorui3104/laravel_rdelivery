<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'shop_id' => 1,
                'name' => 'こってりらーめん',
                'price' => 800,
                'information' => '独自の製法で仕上げた自慢のスープ。コク深いとんこつの風味をご堪能ください！',
            ],
            [
                'shop_id' => 1,
                'name' => '特製こってりらーめん',
                'price' => 1000,
                'information' => '独自の製法で仕上げた自慢のスープ。コク深いとんこつの風味をご堪能ください！',
            ],
            [
                'shop_id' => 2,
                'name' => 'あっさりらーめん',
                'price' => 600,
                'information' => '独自の製法で仕上げた自慢のスープ。コク深い煮干しの風味をご堪能ください！',
            ],
            [
                'shop_id' => 2,
                'name' => '特製あっさりらーめん',
                'price' => 800,
                'information' => '独自の製法で仕上げた自慢のスープ。コク深い煮干しの風味をご堪能ください！',
            ],
        ]);
    }
}