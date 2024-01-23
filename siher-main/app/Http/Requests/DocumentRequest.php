<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'khs' => [
                'required', 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx', 'max:2500',
            ],
            'krs' => [
                'required', 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx', 'max:2500',
            ],
            'uk' => [
                'required', 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx', 'max:2500',
            ],
        ];
    }
}
