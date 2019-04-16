<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreForPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_for_photos', function (Blueprint $table) {
            $table->integer('genre_photo_id');
            $table->integer('photo_id');

            $table->foreign('genre_photo_id')->references('id')->on('genre_photos');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->primary(['genre_photo_id', 'photo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_for_photos');
    }
}
