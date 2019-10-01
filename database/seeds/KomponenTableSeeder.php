<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class KomponenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=0; $i < 20; $i++) { 
        	$data[] = [
                'user_id' => rand(1, 4),
                'kode' => time() + rand(11111, 99999),
        		'nama' => $faker->sentence(2),
        		'tipe' => $faker->randomElement(['umum', 'motor', 'mobil', 'sepeda']),
        		'bagian' => $faker->word,
        		'created_at' => now(),
        		'updated_at' => now(),
        	];
        }
        DB::table('komponen')->truncate();
        DB::table('komponen')->insert($data);
    }
}
