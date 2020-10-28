<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    public function doctors()
    {
        return $this->hasMany('App\Doctor');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }
}
