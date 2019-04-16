<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatVideo extends Model
{
    protected $table='format_videos';
    protected $fillable=['title'];

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

}
