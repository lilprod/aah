<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Disease extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'scientific_name' => $this->scientific_name,
            'description' => $this->description,
            'treatment'=> $this->treatment,
            'cover_image' => $this->cover_image,
            'attach_file' => $this->attach_file,
            'video_url' => $this->video_url,
            //'meta_keywords' => $this->meta_keywords,
            //'meta_description' => $this->meta_description,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
