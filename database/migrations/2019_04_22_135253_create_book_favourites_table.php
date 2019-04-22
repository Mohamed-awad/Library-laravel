<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_favourites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bookId')->unsigned();
            $table->bigInteger('userId')->unsigned();
            $table->foreign('bookId')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('book_favourites');
    }
}
