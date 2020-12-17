<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Answer::class, 'parent_id');
    }
}
