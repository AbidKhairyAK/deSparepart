<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PelangganTableSeeder::class);
        $this->call(PemasokTableSeeder::class);
        $this->call(KontakPelangganTableSeeder::class);
        $this->call(KontakPemasokTableSeeder::class);
        $this->call(KomponenTableSeeder::class);
        $this->call(KendaraanTableSeeder::class);
        $this->call(BarangTableSeeder::class);
        $this->call(PenjualanDetailTableSeeder::class);
        $this->call(PenjualanTableSeeder::class);
        $this->call(PembayaranPiutangTableSeeder::class);

    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
