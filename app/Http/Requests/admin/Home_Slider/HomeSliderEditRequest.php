<?php

namespace App\Http\Requests\admin\Home_Slider;

use Illuminate\Foundation\Http\FormRequest;

class HomeSliderEditRequest extends FormRequest
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
        if ($this->image == null)
        {
            return [
                'order'=>'required|min:1',
            ];
        }
        else
        {
            return [
                'order'=>'required|min:1',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ];
        }
    }
}
