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
            $table->string('part_no', 100)->unique();
            $table->string('nama');
            $table->integer('stok');
            $table->enum('satuan', ['pcs', 'sachet', 'biji', 'box', 'dus', 'meter', 'centimeter', 'lusin', 'ikat']);
            $table->smallInteger('limit');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->string('gambar', 15)->nullable();
            $table->string('keterangan');
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
        Schema::dropIfExists('barang');
    }
}
