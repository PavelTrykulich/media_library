<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable=['file_id','format_photo_id'];

    public function file()
    {
        return $this->belongsTo('App\File');
    }

    public function genres()
    {
        return $this->belongsToMany('App\GenrePhoto','genre_for_photos','photo_id','genre_photo_id');
    }

    public function format()
    {
        return $this->belongsTo('App\FormatPhoto','format_photo_id','id');
    }

    public function audios()
    {
        return $this->belongsToMany('App\Audio','photo_for_audios');
    }

    public function videos()
    {
        return $this->belongsToMany('App\Video','photo_for_videos');
    }
}
