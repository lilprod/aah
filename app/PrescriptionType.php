<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionType extends Model
{
    public function prescriptions()
    {
        return $this->hasMany('App\Prescription');
    }
}
