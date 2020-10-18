<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'username' => 'required|string|max:255|unique:users,username,'.$this->id.',id',
            'email' => 'required|email|max:255|unique:users,email,'.$this->id.',id',
            'address' => 'required|string|max:255',
            'mobile' => 'required|min:1',
        ];
    }
}
