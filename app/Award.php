<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
