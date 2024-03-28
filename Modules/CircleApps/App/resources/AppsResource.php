<?php

namespace Modules\CircleApps\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppsResource extends JsonResource
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
            
            'account' => $this->id,
            'name' => $this->name,
            'key' => $this->key,
            'readme' => $this->readme,
            'homepage' => $this->homepage,
            'email' => $this->email,
            'docs' => $this->docs,
            'github' => $this->github,
            'privacy' => $this->privacy,
            'faq' => $this->faq,
            'status' => $this->status,
            'is_active' => $this->is_active,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_to' => $this->discount_to,
            'is_free' => $this->is_free,

        ];
    }
}
