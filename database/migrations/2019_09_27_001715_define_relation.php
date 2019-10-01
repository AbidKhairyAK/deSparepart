<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefineRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('permission_role', function (Blueprint $table) {
        //     $table->foreign('role_id')->references('id')->on('roles');
        //     $table->foreign('permission_id')->references('id')->on('permissions');
        // });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->foreign('role_id')->references('id')->on('roles');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
