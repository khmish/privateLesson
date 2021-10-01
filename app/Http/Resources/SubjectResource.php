<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'leveleducation_id' => $this->leveleducation_id,
            'name' => $this->name,
            'pic' => $this->pic,
            'lesssons' => LesssonCollection::make($this->whenLoaded('lesssons')),
        ];
    }
}
