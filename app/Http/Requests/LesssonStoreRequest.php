<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LesssonStoreRequest extends FormRequest
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
            'student_id' => ['integer'],
            'teacher_id' => ['integer'],
            'subject_id' => [ 'integer', 'exists:subjects,id'],
            'date_execution' => [],
            'state' => [ 'string'],
        ];
    }
}
