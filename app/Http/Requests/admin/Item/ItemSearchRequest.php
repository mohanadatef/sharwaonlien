<?php

namespace App\Http\Requests\admin\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemSearchRequest extends FormRequest
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
        if ($this->id == null)
        {
            return [
                'brand_id'=>'required',
                'category_type_id'=>'required',
                'type_id'=>'required',
                'size_id'=>'required',
                'color_id'=>'required',
                'gender_id'=>'required',
            ];
        }
        else
        {
            return [
                'id'=>'required',
            ];
        }
    }
}
