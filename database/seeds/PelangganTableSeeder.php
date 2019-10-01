<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PelangganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=1; $i < 10; $i++) { 
        	$data[] = [
        		"user_id" => rand(1, 4),
        		"kode" => "190928".rand(100, 999),
        		"nama" => $faker->name,
        		"toko" => "Toko ".$faker->firstName(),
        		"alamat" => $faker->address,
        		"kategori" => $faker->randomElement(['bengkel', 'toko', 'umum']),
        		"created_at" => now(),
        		"updated_at" => now(),
        	];
        }

        DB::table('pelanggan')->truncate();
        DB::table('pelanggan')->insert($data);
    }
}
