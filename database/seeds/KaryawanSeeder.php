<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class KaryawanSeeder extends Seeder
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
        		"jabatan_id" => rand(1, 4),
                "nama" => $faker->name,
        		"email" => $faker->email,
        		"alamat" => $faker->address,
        		"gaji" => $faker->numberBetween(1000000, 9000000),
                "phone" => $faker->phoneNumber,
                "foto" => null,
        		"created_at" => now(),
        		"updated_at" => now(),
        	];
        }

        DB::table('karyawan')->truncate();
        DB::table('karyawan')->insert($data);
    }
}
