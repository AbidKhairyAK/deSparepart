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
        $this->call(CustomerTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(KontakCustomerTableSeeder::class);
        $this->call(KontakSupplierTableSeeder::class);
        $this->call(KomponenTableSeeder::class);
        $this->call(KendaraanTableSeeder::class);
        $this->call(SatuanTableSeeder::class);
        $this->call(BarangTableSeeder::class);
        $this->call(PenjualanDetailTableSeeder::class);
        $this->call(PenjualanTableSeeder::class);
        $this->call(PembelianDetailTableSeeder::class);
        $this->call(PembelianTableSeeder::class);
        $this->call(PembayaranPiutangTableSeeder::class);
        $this->call(PembayaranHutangTableSeeder::class);
        $this->call(ReturPenjualanDetailTableSeeder::class);
        $this->call(ReturPenjualanTableSeeder::class);
        $this->call(ReturPembelianDetailTableSeeder::class);
        $this->call(ReturPembelianTableSeeder::class);
        $this->call(InventarisTableSeeder::class);
        $this->call(LabaTableSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(KaryawanSeeder::class);
        // $this->call(TestBarangDetailStok::class);


    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
