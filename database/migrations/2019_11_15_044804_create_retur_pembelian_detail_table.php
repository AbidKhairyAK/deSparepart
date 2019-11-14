<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturPembelianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_pembelian_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('retur_pembelian_id');
            $table->unsignedBigInteger('pembelian_detail_id');
            $table->integer('qty');
            $table->integer('biaya');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('retur_pembelian_detail');
    }
}
