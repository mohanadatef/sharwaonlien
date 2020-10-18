<?php

namespace App\Http\Requests\admin\Job;

use Illuminate\Foundation\Http\FormRequest;

class JobCreateRequest extends FormRequest
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
            'tittel'=>'required',
            'description'=>'required',
            'order'=>'required|min:1',
        ];
    }
}
