<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'description' => $this->description,
            'body'=> $this->body,
            'cover_image' => $this->cover_image,
            'attach_file' => $this->attach_file,
            'video_url' => $this->video_url,
            'category_id' => $this->category_id,
            //'meta_keywords' => $this->meta_keywords,
            //'meta_description' => $this->meta_description,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
