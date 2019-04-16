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
            $table->integer('file_id');
            $table->timestamps();

            $table->primary(['file_id','audio_id']);
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
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
