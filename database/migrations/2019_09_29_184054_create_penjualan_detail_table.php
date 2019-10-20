<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('penjualan_id');
            $table->unsignedBigInteger('barang_id');
            $table->string('part_no', 100);
            $table->string('nama');
            $table->integer('qty');
            $table->string('satuan');
            $table->integer('harga');
            $table->integer('diskon');
            $table->integer('subtotal');
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
        Schema::dropIfExists('penjualan_detail');
    }
}
