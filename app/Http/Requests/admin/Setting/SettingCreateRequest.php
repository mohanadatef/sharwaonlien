<?php

namespace App\Http\Requests\admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingCreateRequest extends FormRequest
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
            'facebook'=> 'required',
            'instgram'=> 'required',
            'image'=> 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'logo'=> 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
