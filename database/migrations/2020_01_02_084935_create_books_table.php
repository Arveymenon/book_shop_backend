<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
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
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('mrp_in_rupees');
            $table->integer('board_id');
            $table->string('book_type')->nullable();
            $table->string('publisher')->nullable();
            $table->string('subject');
            $table->string('authors')->nullable();
            $table->integer('language_id');
            $table->date('print_date')->nullable();
            $table->string('standard')->nullable();
            $table->tinyInteger('refurbished_available')->default(0)->length(1)->unsigned();
            $table->tinyInteger('active')->length(1)->unsigned();
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
        Schema::dropIfExists('books');
    }
}
