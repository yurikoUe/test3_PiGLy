<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register2Request extends FormRequest
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
            'weight' => 'required|numeric|regex:/^\d+(\.\d{1,1})?$/|max:9999',
            'target_weight' => 'required|numeric|regex:/^\d+(\.\d{1,1})?$/|max:9999',
        ];
    }

    public function messages()
    {
        return [
            'weight.required' => '現在の体重を入力してください',
            'weight.numeric' => '4桁までの数字で入力してください',
            'weight.regex' => '少数点以下1桁で入力してください',
            'weight.max' => '4桁までの数字で入力してください',
            'target_weight.required' => '目標体重を入力してください。',
            'target_weight.numeric' => '4桁までの数字で入力してください',
            'target_weight.regex' => '少数点以下1桁で入力してください',
            'target_weight.max' => '4桁までの数字で入力してください',
        ];
    }
}
