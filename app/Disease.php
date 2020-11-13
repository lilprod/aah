<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getLink()
    {
        return url('disease/'.$this->slug);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeFilter($query, $params)
    {

        /*if ( isset($params['title']) && trim($params['title'] !== '') ) {
            $query->where('title', 'LIKE', trim($params['title']).'%');
        }

        if ( isset($params['scientific_name']) && trim($params['scientific_name'] !== '') ) {

            $query->where('scientific_name', 'LIKE', trim($params['scientific_name']).'%');

        }*/

        if ( isset($params['query']) && trim($params['query'] !== '') ) {

            $query->where('title', 'LIKE', trim($params['query']).'%')
                  ->orWhere('scientific_name', 'LIKE', trim($params['query']).'%');
        }

        return $query;
    }

    /*public function category()
    {
        return $this->belongsTo('App\Category');
    }*/
}
