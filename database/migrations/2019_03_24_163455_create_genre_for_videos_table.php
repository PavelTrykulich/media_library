<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreForVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_for_videos', function (Blueprint $table) {
            $table->integer('genre_video_id');
            $table->integer('video_id');

            $table->foreign('genre_video_id')->references('id')->on('genre_videos');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->primary(['genre_video_id','video_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_for_videos');
    }
}
