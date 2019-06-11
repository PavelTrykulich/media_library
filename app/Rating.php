<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable=['rating','file_id','user_id'];
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function file()
    {
        return $this->belongsTo('App\File');
    }
}
