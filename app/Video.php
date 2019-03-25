<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table='videos';
    public $primaryKey='video_id';
    protected $fillable=['file_id','format_video_id'];

    public function file()
    {
        return $this->belongsTo('App\File','file_id','file_id');
    }

    public function genreVideos()
    {
        return $this->belongsToMany('App\GenreVideo','genre_for_videos','video_id','genre_video_id');
    }

    public function formatVideo()
    {
        return $this->belongsTo('App\FormatVideo','format_id','format_id');
    }
}
