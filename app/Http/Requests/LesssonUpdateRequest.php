<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LesssonUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => ['integer', 'exists:users,id'],
            'teacher_id' => ['integer', 'exists:users,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'date_execution' => [''],
            'state' => ['required', 'string'],
        ];
    }
}
