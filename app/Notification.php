<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function receiver()
    {
        return $this->belongsTo(User::class);
    }
}
