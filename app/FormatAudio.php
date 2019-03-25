<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatAudio extends Model
{
    protected $table='format_audios';
    public $primaryKey='format_audio_id';
    protected $fillable=['title'];

    public function audios()
    {
        return $this->hasMany('App\Audio','format_audio_id','format_audio_id');
    }
}
