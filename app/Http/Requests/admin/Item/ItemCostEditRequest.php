<?php

namespace App\Http\Requests\admin\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemCostEditRequest extends FormRequest
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
            'price'=>'required|min:1',
            'order'=>'required|min:1',
        ];

    }
}
