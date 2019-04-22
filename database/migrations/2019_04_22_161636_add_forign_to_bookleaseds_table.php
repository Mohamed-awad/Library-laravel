<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForignToBookleasedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_leaseds', function (Blueprint $table) {
            //
              $table->foreign('bookId')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_leaseds', function (Blueprint $table) {
            //
        });
    }
}
