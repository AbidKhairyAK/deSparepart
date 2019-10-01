<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class KendaraanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $data[0] = [
            'user_id' => 1,
            'kode' => "0000000000",
            'merk' => 'UMUM',
            'pabrikan' => 'UMUM',
            'tipe' => 'lainnya',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for ($i=0; $i < 20; $i++) { 
        	$data[] = [
                'user_id' => rand(1, 4),
                'kode' => time() + rand(11111, 99999),
        		'merk' => title_case($faker->sentence(2)),
        		'pabrikan' => title_case($faker->word),
        		'tipe' => $faker->randomElement(['motor', 'mobil', 'sepeda', 'lainnya']),
        		'created_at' => now(),
        		'updated_at' => now(),
        	];
        }
        DB::table('kendaraan')->truncate();
        DB::table('kendaraan')->insert($data);
    }
}
