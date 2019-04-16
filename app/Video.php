<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table='videos';
    protected $fillable=['file_id','format_video_id'];

    public function file()
    {
        return $this->belongsTo('App\File');
    }

    public function genres()
    {
        return $this->belongsToMany('App\GenreVideo','genre_for_videos','video_id','genre_video_id');
    }

    public function format()
    {
        return $this->belongsTo('App\FormatVideo');
    }
}
