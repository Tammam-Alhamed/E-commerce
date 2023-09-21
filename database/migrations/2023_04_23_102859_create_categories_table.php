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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('categories_id');
            $table->unsignedBigInteger('categories_shope')->nullable();
            $table->foreign('categories_shope' ,'categories_shope' )->references('shopes_id')->on('shopes');
            $table->string('categories_name');
            $table->string('categories_name_ar');
            $table->string('categories_image');
            $table->timestamp('categories_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
