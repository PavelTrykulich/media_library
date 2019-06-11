<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'second_name','first_name','patronymic','avatar',
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
        return $this->hasMany('App\File');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function getFullNameUser()
    {
        return $this->first_name . $this->second_name;
    }

    public function topThreeFileUser(){
        $topThreeFilesUser =File::selectRaw('files.*, avg(ratings.rating) as avr')
            ->join('ratings','ratings.file_id','=','files.id')
            ->where('files.user_id',$this->id)
            ->groupBy('files.id')
            ->orderBy('avr','desc')
            ->limit(3)
            ->get();
        return $topThreeFilesUser;
    }

    public function avg_ret_author(){
       $rating =  DB::select('select * from avg_rat_auth(?)',[$this->id]);
       $rating = array_shift($rating);
       return $rating->avg_rat_auth;
    }





}
