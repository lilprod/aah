<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
