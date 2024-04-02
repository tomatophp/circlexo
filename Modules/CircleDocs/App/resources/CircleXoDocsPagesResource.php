<?php

namespace Modules\CircleDocs\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CircleXoDocsPagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
            'parent_id' => $this->parent_id,
            'icon' => $this->icon,
            'color' => $this->color,
            'slug' => $this->slug,
            'doc' => $this->id,

        ];
    }
}
