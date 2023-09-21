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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('orders_id');
            $table->unsignedBigInteger('orders_usersid');
            $table->foreign('orders_usersid' )->references('id')->on('users');

            $table->unsignedBigInteger('orders_address');
            $table->foreign('orders_address' , 'orders_address')->references('address_id')->on('address');
            $table->tinyInteger('orders_type')->default(0);// 0 => delivery ; 1 => recive
            $table->integer('orders_pricedelivery')->default(0);
            $table->integer('orders_price');
            $table->integer('orders_coupon')->default(0);
            $table->double('orders_totalprice')->default(0);
            $table->tinyInteger('orders_rating')->default(0);
            $table->string('orders_noterating')->nullable();
            $table->tinyInteger('orders_paymentmethod')->default(0);// 0 => cash ; 1 => card
            $table->tinyInteger('orders_status')->default(0);
            $table->dateTime('orders_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
