<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    public $primaryKey = 'file_id';
    protected $fillable = ['user_id','title','type_file','description','short_description','date_last_eval','path_to_file'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','file_id','file_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating','file_id','file_id');
    }

    public function audio()
    {
        return $this->hasOne('App\Audio','file_id','file_id');
    }

    public function video()
    {
        return $this->hasOne('App\Video','file_id','file_id');
    }

    public function photo()
    {
        return $this->hasOne('App\Photo','file_id','file_id');
    }

    public function getGenres($file){

    }

}
