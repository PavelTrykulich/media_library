<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreVideo extends Model
{
    protected $table='genre_videos';
    public $primaryKey='genre_video_id';
    protected $fillable=['title'];

    public function videos()
    {
        return $this->belongsToMany('App\Video','genre_for_videos','genre_video_id','video_id');
    }
}
