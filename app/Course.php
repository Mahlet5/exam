<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function seasons(){
        return $this->hasMany('App\Season');
    }
}
