<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class Customer_Request extends FormRequest
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
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'email|max:255|unique:users,email',
            'mobile' => 'required|min:11|unique:customers',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
