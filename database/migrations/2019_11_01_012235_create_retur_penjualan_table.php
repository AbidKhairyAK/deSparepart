<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('penjualan_id');
            $table->string('no_retur', 100);
            $table->enum('pembayaran', ['tunai', 'giro', 'kredit', 'transfer']);
            $table->string('pembayaran_detail', 20)->nullable();
            $table->integer('dikurangi')->default(0);
            $table->integer('dikembalikan')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retur_penjualan');
    }
}
