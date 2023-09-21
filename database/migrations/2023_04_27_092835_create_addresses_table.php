<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('address_id');
            $table->unsignedBigInteger('address_usersid')->nullable();
            $table->foreign('address_usersid' )->references('id')->on('users');
            $table->string('address_name')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_street')->nullable();
            $table->double('address_lat')->nullable();
            $table->double('address_long')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
};
