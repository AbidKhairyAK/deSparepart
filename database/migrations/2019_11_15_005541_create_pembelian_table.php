<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('supplier_id');
            $table->string('no_faktur', 100)->nullable();
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
        Schema::dropIfExists('pembelian');
    }
}
