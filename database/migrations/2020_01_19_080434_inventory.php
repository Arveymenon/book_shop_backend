<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('input_type');
            $table->bigInteger('retailer_book_id');
            $table->bigInteger('count');
            $table->bigInteger('balance_count')->default(0);
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
}
