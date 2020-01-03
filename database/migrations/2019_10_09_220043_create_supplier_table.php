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
            $table->string('perusahaan');
            $table->string('pemilik')->nullable();
            $table->string('cp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('npwp')->nullable();
            $table->boolean('pkp')->default(0);
            $table->unsignedTinyInteger('tempo_kredit')->default(0);
            $table->string('kategori');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('supplier');
    }
}
