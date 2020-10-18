<?php

namespace App\Http\Requests\admin\PricesDelivery;

use Illuminate\Foundation\Http\FormRequest;

class PricesDeliveryEditRequest extends FormRequest
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
            'prices'=>'required',
            'city_id'=>'required',
            'area_id'=>'required',
            'company_delivery_id'=>'required',
        ];
    }
}
