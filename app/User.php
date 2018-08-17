<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function profile()
    {
      return $this->hasOne('App\Profile');
    }

    public function role()
    {
      return $this->hasOne('App\Role');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course')->withPivot('course_id');
    }

    public function seasons()
    {
        return $this->belongsToMany('App\Season')->withPivot('season_id');
    }
}
