<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatPhoto extends Model
{
    protected $table='format_photos';
    protected $fillable=['title'];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

}
