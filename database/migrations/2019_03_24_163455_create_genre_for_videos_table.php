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
            $table->timestamps();

            $table->foreign('genre_video_id')->references('genre_video_id')->on('genre_videos');
            $table->foreign('video_id')->references('video_id')->on('videos')->onDelete('cascade') ;
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
