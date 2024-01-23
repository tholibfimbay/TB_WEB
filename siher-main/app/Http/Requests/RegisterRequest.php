<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fname' => 'required',
            'lname' => 'required',
            'nim' => ['required', 'unique:App\User,nim'],
            'email' => ['required', 'unique:App\User,email'],
            'password' => ['min:6', 'required_with:password_confir', 'same:password_confir'],

        ];
    }
}
