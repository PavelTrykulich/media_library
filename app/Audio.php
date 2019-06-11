<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $fillable=['file_id','format_audio_id'];
    protected $table = 'audios';

    public function file()
    {
        return $this->belongsTo('App\File');
    }

    public function genres()
    {
        return $this->belongsToMany('App\GenreAudio','genre_for_audios','audio_id','genre_audio_id');
    }

    public function format()
    {
        return $this->belongsTo('App\FormatAudio','format_audio_id','id');
    }

    public function photos()
    {
        return $this->belongsToMany('App\Photo','photo_for_audios');
    }

}
