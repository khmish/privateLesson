<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LesssonResource extends JsonResource
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
            'student_id' => $this->student_id,
            'teacher_id' => $this->teacher_id,
            'student' => UserCollection::make($this->student),
            'teacher' => UserCollection::make($this->teacher),
            'subject_id' => $this->subject_id,
            'date_execution' => $this->date_execution,
            'state' => $this->state,
        ];
    }
}
