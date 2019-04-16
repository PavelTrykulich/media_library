<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatAudio extends Model
{
    protected $table='format_audios';
    protected $fillable=['title'];

    public function audios()
    {
        return $this->hasMany('App\Audio');
    }
}
