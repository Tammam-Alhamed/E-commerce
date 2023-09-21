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
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('cart_id');
            $table->unsignedBigInteger('cart_usersid')->nullable();
            $table->foreign('cart_usersid' )->references('id')->on('users');

            $table->unsignedBigInteger('cart_itemsid')->nullable();
            $table->foreign('cart_itemsid' ,'cart_itemsid' )->references('items_id')->on('items');
            $table->integer('cart_orders')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
