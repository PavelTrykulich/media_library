<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table='audios';
    public $primaryKey='audio_id';
    protected $fillable=['file_id','format_audio_id'];

    public function file()
    {
        return $this->belongsTo('App\File','file_id','file_id');
    }

    public function genreAudios()
    {
        return $this->belongsToMany('App\GenreAudio','genre_for_audios','audio_id','genre_audio_id');
    }

    public function formatAudio()
    {
        return $this->belongsTo('App\FormatAudio','format_id','format_id');
    }
}
