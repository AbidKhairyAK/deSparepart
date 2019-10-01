<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('pelanggan_id');
            $table->char('no_faktur', 19);
            $table->char('no_nota', 9);
            $table->enum('pembayaran', ['tunai', 'kredit', 'giro']);
            $table->integer('dibayarkan');
            $table->integer('hutang')->nullable();
            $table->boolean('status_hutang');
            $table->boolean('status_post');
            $table->date('jatuh_tempo')->nullable();
            $table->integer('total');
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
        Schema::dropIfExists('penjualan');
    }
}
