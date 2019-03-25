<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table='ratings';
    public $primaryKey='rating_id';
    protected $fillable=['rating','file_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }

    public function file()
    {
        return $this->belongsTo('App\File','file_id','file_id');
    }
}
