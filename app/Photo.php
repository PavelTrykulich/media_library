<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable=['file_id','format_photo_id'];

    public function file()
    {
        return $this->belongsTo('App\File','file_id','file_id');
    }

    public function genres()
    {
        return $this->belongsToMany('App\GenrePhoto','genre_for_photos','photo_id','genre_photo_id');
    }

    public function format()
    {
        return $this->belongsTo('App\FormatPhoto','format_photo_id','format_photo_id');
    }
}
