<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('product_type')->comment('1 -> book, 2 -> product');
            $table->bigInteger('product_id');
            $table->tinyInteger('refurbished')->length('1')->default(0);
            $table->integer('quantity');
            $table->integer('filler_1')->nullable();
            $table->integer('filler_2')->nullable();
            $table->integer('filler_3')->nullable();
            $table->integer('filler_4')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
