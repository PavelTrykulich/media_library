<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $primaryKey='user_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'second_name','first_name','patronymic','path_to_photo',
        'phone','description','date_birth', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function files()
    {
        return $this->hasMany('App\File','user_id','user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','user_id','user_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating','user_id','user_id');
    }
}
