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
            'student' => $this->student,
            'teacher' => $this->teacher,
            'price' => $this->teacher->tutor!=null?$this->teacher->tutor->price:"",
            'subject' => $this->subject,
            'subject_id' => $this->subject_id,
            'date_execution' => $this->date_execution,
            'state' => $this->state,
        ];
    }
}
