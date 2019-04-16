<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenrePhoto extends Model
{
    protected $table='genre_photos';
    protected $fillable=['title'];

    public function photos()
    {
        return $this->belongsToMany('App\Photo','genre_for_photos','genre_photo_id','photo_id');
    }


}
