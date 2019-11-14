<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class SupplierTableSeeder extends Seeder
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
        		"kode" => "19092800".$i,
                "perusahaan" => "PT. ".$faker->firstName(),
        		"pemilik" => $faker->name,
                "cp" => $faker->firstName()." ".$faker->lastName(),
                "alamat" => $faker->address,
                "npwp" => rand(11, 99).'.'.rand(111, 999).'.'.rand(111, 999).'.'.rand(1, 9).'-'.rand(111, 999).'.'."000",
        		"pkp" => rand(1,0),
        		"kategori" => $faker->randomElement(['importir', 'dealer']),
                'tempo_kredit' => rand(10, 30),
        		"created_at" => now(),
        		"updated_at" => now(),
        	];
        }

        DB::table('supplier')->truncate();
        DB::table('supplier')->insert($data);
    }
}
