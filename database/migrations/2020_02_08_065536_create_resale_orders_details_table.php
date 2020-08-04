<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResaleOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resale_orders_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('resale_order_id');
            $table->bigInteger('order_details_id');
            $table->bigInteger('quantity');
            $table->bigInteger('status')->nullable()->length(1)->default(1)->comment('0 -> processing, 1 -> Completed, 2-> Rejected, 3-> cancelled');
            $table->bigInteger('rating')->nullable()->default(0);
            $table->bigInteger('resale_value')->nullable()->default(0);
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
        Schema::dropIfExists('resale_orders_details');
    }
}
