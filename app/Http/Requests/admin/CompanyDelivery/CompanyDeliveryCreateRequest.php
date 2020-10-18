<?php

namespace App\Http\Requests\admin\CompanyDelivery;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDeliveryCreateRequest extends FormRequest
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
            'name'=>'required',
            'address'=>'required',
            'performance'=>'required',
            'mobile'=>'required|min:11',
        ];
    }
}
