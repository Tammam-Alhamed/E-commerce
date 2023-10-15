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
        Schema::create('favorite', function (Blueprint $table) {
            $table->bigIncrements('favorite_id');
            $table->unsignedBigInteger('favorite_usersid')->nullable();
            $table->foreign('favorite_usersid' )->references('id')->on('users');

            $table->unsignedBigInteger('favorite_itemsid')->nullable();
            $table->foreign('favorite_itemsid' ,'favorite_itemsid' )->references('items_id')->on('items');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite');
    }
};
