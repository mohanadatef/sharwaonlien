<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class Finish_Request extends FormRequest
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
            'name' => 'string|max:255',
            'address' => 'required|string|max:255',
            'Apartment' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'email' => 'string|email|max:255',
            'mobile' => 'required|min:1',
        ];
    }
}
