<?php

namespace App\Http\Requests\admin\Bag;

use Illuminate\Foundation\Http\FormRequest;

class ManageBagEditRequest extends FormRequest
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
                'cost_buy'=>'required|min:1',
                'cost_profit'=>'required|min:1',
            ];
    }
}
