<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code');
            $table->mediumText('description')->nullable();
            $table->integer('uses')->comment('counter for the number of time it has been used')->default(0)->unsigned();
            $table->integer('max_uses')->default(99999999)->unsigned();
            $table->integer('max_user')->default(99999999)->unsigned();
            $table->integer('max_user_uses')->default(99999999)->unsigned();
            $table->integer('minimum_cart_total')->default(0)->unsigned();
            $table->integer('minimum_cart_total_type')->comment('0-> none, 1-> books, 2-> products')->default(0)->unsigned();
            $table->integer('minimum_cart_total_type_value')->comment('minimum_cart_total_type minimum total')->default(0)->nullable()->unsigned();
            $table->integer('discount_amount')->default(0)->unsigned();
            $table->integer('discount_type')->default(0)->unsigned()->comment('1-> fixed amount, 2-> percentage');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('expire_at')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
