<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreAudio extends Model
{
    protected $table='genre_audios';
    public $primaryKey='genre_audio_id';
    protected $fillable=['title'];

    public function audios()
    {
        return $this->belongsToMany('App\Audio','genre_for_audios','genre_audio_id','audio_id');
    }
}
