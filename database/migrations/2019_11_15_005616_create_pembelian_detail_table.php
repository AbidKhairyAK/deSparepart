<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pembelian_id');
            $table->unsignedBigInteger('barang_id');
            $table->string('part_no', 100);
            $table->string('nama');
            $table->integer('qty');
            $table->integer('stok');
            $table->string('satuan');
            $table->integer('harga');
            $table->integer('harga_asli');
            $table->tinyInteger('diskon')->default(0);
            $table->tinyInteger('ppn')->default(0);
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
        Schema::dropIfExists('pembelian_detail');
    }
}
