<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    public $primaryKey='comment_id';
    protected $fillable=['text_comment','file_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }

    public function file()
    {
        return $this->belongsTo('App\File','file_id','file_id');
    }
}
