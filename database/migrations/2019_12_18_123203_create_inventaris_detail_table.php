<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('tanggal');
            $table->unsignedBigInteger('inventaris_id');
            $table->unsignedMediumInteger('inv_qty')->nullable();
            $table->unsignedMediumInteger('inv_stok')->nullable();
            $table->unsignedInteger('inv_harga')->nullable();
            $table->unsignedInteger('inv_total')->nullable();
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
        Schema::dropIfExists('inventaris_detail');
    }
}
