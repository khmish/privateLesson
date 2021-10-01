<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectUpdateRequest extends FormRequest
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
            'leveleducation_id' => ['required', 'integer', 'exists:leveleducations,id'],
            'name' => ['required', 'string', 'max:100'],
            'pic' => ['required', 'string'],
        ];
    }
}
