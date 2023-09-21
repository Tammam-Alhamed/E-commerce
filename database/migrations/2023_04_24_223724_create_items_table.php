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
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('items_id');
            $table->unsignedBigInteger('items_cat')->nullable();
            // $table->foreign('items_cat')->references('categories_id ')->on("categories")->onDelete('cascade');
            $table->foreign('items_cat' ,'items_cat' )->references('categories_id')->on('categories');
            $table->string('items_name')->nullable();
            $table->string('items_name_ar')->nullable();
            $table->string('items_desc')->nullable();
            $table->string('items_desc_ar')->nullable();
            $table->string('items_image')->nullable();
            $table->integer('items_count')->nullable();
            $table->string('items_active')->nullable();
            $table->float('items_price')->nullable();
            $table->smallInteger('items_discount')->nullable();
            $table->timestamp('items_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};

