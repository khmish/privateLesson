<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'password'],
            'email_verified_at' => [''],
            'dateOfBirth' => [''],
            'exceprience' => ['string'],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'pic' => ['string'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
        ];
    }
}
