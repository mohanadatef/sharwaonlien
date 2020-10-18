<?php

namespace App\Http\Requests\admin\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemEditRequest extends FormRequest
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
                'brand_id'=>'required',
                'category_type_id'=>'required',
                'type_id'=>'required',
                'size_id'=>'required',
                'color_id'=>'required',
                'weight'=>'required',
                'image_main' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ];
    }
}
