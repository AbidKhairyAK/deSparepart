<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('komponen_id');
            $table->unsignedInteger('kendaraan_id');
            $table->unsignedInteger('satuan_id');
            $table->string('kode', 100)->nullable();
            $table->string('part_no', 100)->nullable();
            $table->string('nama');
            $table->string('merk')->nullable();
            $table->integer('stok');
            $table->smallInteger('limit');
            $table->integer('harga_beli')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->string('gambar', 15)->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('barang');
    }
}
