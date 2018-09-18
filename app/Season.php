<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Season extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function materials(){
      return $this->hasMany('App\Material');
    }
}
