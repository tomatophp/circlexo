<?php

namespace Modules\CircleDocs\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CircleXoDocsResource extends JsonResource
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
            
            'name' => $this->name,
            'package' => $this->package,
            'about' => $this->about,
            'repository' => $this->repository,
            'branch' => $this->branch,
            'readme' => $this->readme,
            'is_active' => $this->is_active,
            'is_public' => $this->is_public,
            'group' => $this->group,
            'account' => $this->id,

        ];
    }
}
