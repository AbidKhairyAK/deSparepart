<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontakPemasokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontak_pemasok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pemasok_id');
            $table->enum('tipe', ['hp', 'telepon', 'fax', 'email', 'web', 'sosmed']);
            $table->string('kontak');
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
        Schema::dropIfExists('kontak_pemasok');
    }
}
