<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatVideo extends Model
{
    protected $table='format_videos';
    public $primaryKey='format_video_id';
    protected $fillable=['title'];

    public function videos()
    {
        return $this->hasMany('App\Video','format_video_id','format_video_id');
    }

}
