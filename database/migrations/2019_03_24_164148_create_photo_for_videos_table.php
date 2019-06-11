<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoForVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_for_videos', function (Blueprint $table) {
            $table->integer('video_id');
            $table->integer('photo_id');
            $table->timestamps();

            $table->primary(['photo_id','video_id']);
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_for_videos');
    }
}
