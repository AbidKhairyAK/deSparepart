<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->char('kode', 9)->unique(); // 6 angka tanggal, 3 angka urut
            $table->string('logo', 15)->nullable();
            $table->string('perusahaan');
            $table->string('pemilik');
            $table->string('cp');
            $table->string('alamat');
            $table->string('npwp');
            $table->boolean('pkp');
            $table->string('kategori');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('supplier');
    }
}
