<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranHutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_hutang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pembelian_id');
            $table->char('no_pelunasan', 10);
            $table->integer('hutang');
            $table->integer('dibayarkan');
            $table->integer('sisa');
            $table->enum('pembayaran', ['tunai', 'giro', 'kredit', 'transfer']);
            $table->string('pembayaran_detail', 20)->nullable();
            $table->string('status_lunas');
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
        Schema::dropIfExists('pembayaran_hutang');
    }
}
