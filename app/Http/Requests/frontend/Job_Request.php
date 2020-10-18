<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class Job_Request extends FormRequest
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
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'mobile'=>'required',
            'year'=>'required',
            'day'=>'required',
            'month'=>'required',
            'year'=>'required',
            'grade'=>'required',
            'message'=>'required',
            'resume'=>'required|file|mimes:pdf',
        ];
    }
}
