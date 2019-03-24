<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreForAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_for_audios', function (Blueprint $table) {
            $table->integer('genre_audio_id');
            $table->integer('audio_id');
            $table->timestamps();

            $table->foreign('genre_audio_id')->references('genre_audio_id')->on('genre_audios');
            $table->foreign('audio_id')->references('audio_id')->on('audios')->onDelete('cascade') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_for_audios');
    }
}
