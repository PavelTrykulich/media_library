<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreVideo extends Model
{
    protected $fillable=['title'];

    public function videos()
    {
        return $this->belongsToMany('App\Video');
    }
}
