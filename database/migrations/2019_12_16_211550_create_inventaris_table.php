<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('tanggal');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('penjualan_detail_id')->nullable();
            $table->unsignedBigInteger('pembelian_detail_id')->nullable();
            $table->unsignedMediumInteger('trx_qty')->nullable();
            $table->unsignedInteger('trx_harga')->nullable();
            $table->unsignedInteger('trx_total')->nullable();
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
        Schema::dropIfExists('inventaris');
    }
}
