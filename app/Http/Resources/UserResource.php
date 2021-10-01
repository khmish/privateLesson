<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'dateOfBirth' => $this->dateOfBirth,
            'exceprience' => $this->exceprience,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'pic' => $this->pic,
            'city_id' => $this->city_id,
            'lesssons' => LesssonCollection::make($this->whenLoaded('lesssons')),
        ];
    }
}
