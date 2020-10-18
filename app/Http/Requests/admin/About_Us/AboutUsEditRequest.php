<?php

namespace App\Http\Requests\admin\About_Us;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsEditRequest extends FormRequest
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
                'description'=>'required',
            ];
        }
        else
        {
            return [
                'description'=>'required',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ];
        }
    }
}
