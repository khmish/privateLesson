<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TutorUserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" =>$this->id,
            "name" =>$this->name,
            "email" =>$this->email,
            "dateOfBirth" =>$this->dateOfBirth,
            "exceprience" =>$this->exceprience,
            "gender" =>$this->gender,
            "phone" =>$this->phone,
            "role" =>$this->role,
            "pic" =>$this->pic,
            "city_id" =>$this->city_id,
            "city" =>$this->city->name??"",
            "rating" =>strval($this->reviews->avg('stars'))??"0",
            "price" =>$this->tutor->price,
            "cert" =>$this->tutor->title_cert,
            "subjects" =>TutorSubResource::collection($this->tutor->tutorSubs),
            "levelEductions" =>TutorLevelEducationResource::collection($this->tutor->tutorLevelEducations)
        ];
    }
}
