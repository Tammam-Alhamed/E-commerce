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
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('auther_id')->nullable();
            $table->foreign('auther_id')->references('id')->on("authers")->onDelete('cascade');

            $table->string('cover');

            $table->text('title');
            $table->text('price');
            $table->text('price_after');
            $table->text('quantity');
    
            $table->longText('content');

            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);


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
        //
    }
};
