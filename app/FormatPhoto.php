<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatPhoto extends Model
{
    protected $table='format_photos';
    public $primaryKey='format_photo_id';
    protected $fillable=['title'];

    public function photos()
    {
        return $this->hasMany('App\Photo','format_photo_id','format_photo_id');
    }

}
