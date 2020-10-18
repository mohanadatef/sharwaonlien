<?php

namespace App\Http\Requests\admin\CompanyDelivery;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDeliveryEditRequest extends FormRequest
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
                'performance'=>'required',
                'mobile'=>'required|min:11',
                'address'=>'required',
            ];
    }
}
