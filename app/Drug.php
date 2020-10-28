<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
	protected $fillable = [
        'name', 'generic_name', 'short_note', 'drugtype_id',
    ];

    public function drugtype()
    {
        return $this->belongsTo('App\DrugType');
    }
}
