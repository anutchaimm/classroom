<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user){
            $user->profile()->create([
                //'prf_id' => $user->id,
                'prf_firstname' => $user->name,
                //'prf_firstname' => $user->name,
                //'image' => 'profile/logo.jpg',
            ]);
        });
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function classroom()
    {
        return $this->hasMany('App\Classroom', 'user_id', 'id');
    }

    public function classroomuser()
    {
        return $this->hasMany('App\ClassroomUser', 'user_id', 'id');
    }
}
