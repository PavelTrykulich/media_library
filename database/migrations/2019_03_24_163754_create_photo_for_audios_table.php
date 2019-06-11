<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoForAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_for_audios', function (Blueprint $table) {
            $table->integer('audio_id');
            $table->integer('photo_id');
            $table->timestamps();

            $table->primary(['photo_id','audio_id']);
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->foreign('audio_id')->references('id')->on('audios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_for_audios');
    }
}
