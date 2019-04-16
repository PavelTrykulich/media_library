<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id','title','type_file','description',
        'short_description','date_last_eval','path_to_file','size'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function audio()
    {
        return $this->hasOne('App\Audio');
    }

    public function video()
    {
        return $this->hasOne('App\Video');
    }

    public function photo()
    {
        return $this->hasOne('App\Photo');
    }



}
