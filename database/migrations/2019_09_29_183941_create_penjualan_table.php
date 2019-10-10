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
            $table->unsignedInteger('customer_id');
            $table->char('no_faktur', 14)->unique();
            $table->string('no_po', 30)->nullable();
            $table->enum('pembayaran', ['tunai', 'giro', 'kredit', 'transfer']);
            $table->string('pembayaran_detail', 20)->nullable();
            $table->integer('dibayarkan');
            $table->integer('hutang')->nullable();
            $table->boolean('status_lunas');
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
