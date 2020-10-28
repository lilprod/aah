<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function prescribeddrugs()
    {
        return $this->hasMany('App\PrescribedDrugs');
    }

    public function prescritiontype()
    {
        return $this->belongsTo('App\PrescriptionType');
    }
}
