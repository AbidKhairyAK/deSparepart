<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laba', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->integer('total_penjualan');
            $table->integer('retur_penjualan');
            $table->integer('penjualan_bersih');
            $table->integer('total_pembelian');
            $table->integer('retur_pembelian');
            $table->integer('pembelian_bersih');
            $table->integer('persediaan_awal');
            $table->integer('persediaan_siap_jual');
            $table->integer('persediaan_akhir');
            $table->integer('hpp');
            $table->integer('laba_kotor');
            $table->enum('tipe', ['perbulan', 'pertahun']);
            $table->datetime('tanggal_awal');
            $table->datetime('tanggal_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laba');
    }
}
