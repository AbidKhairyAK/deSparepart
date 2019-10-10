<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class KontakCustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=1; $i < 17; $i++) { 
        	$data[] = [
        		"customer_id" => ceil($i/2),
        		"tipe" => ($i%2 == 0) ? 'hp' : 'email',
        		"kontak" => ($i%2 == 0) ? '08'.rand(1111111111, 9999999999) : $faker->freeEmail,
        		"created_at" => now(),
        		"updated_at" => now(),
        	];
        }

        DB::table('kontak_customer')->truncate();
        DB::table('kontak_customer')->insert($data);
    }
}
