<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements("id");
            $table->bigInteger('author_id')->unsigned();
            $table->string('image');
            $table->integer('book_no');
            $table->boolean('status');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->index('author_id');
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
