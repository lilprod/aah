<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = [
    	'user_id', 'doctor_id', 'signature_file', 'status', 'approuved_by', 'approuved_by_name'
	];

	public function user()
	{
	    return $this->belongsTo('App\User');
	}

	public function doctor()
	{
	    return $this->belongsTo('App\Doctor');
	}
}
