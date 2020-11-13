<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Patient extends Model
{
    public function doctors()
    {
        //return $this->belongsToMany(Doctor::class);
        return $this->belongsToMany(Doctor::class, 'doctor_patient', 'patient_id','doctor_id' , 'status')->withTimeStamps();
    }

    public function appointments(){

        return $this->hasMany(Appointment::class);
        
    }
}
