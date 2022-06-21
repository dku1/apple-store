<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'code' => 'required|string|min:6|max:8',
            'denomination' => 'required|numeric',
            'type' => 'required',
            'currency_id' => 'nullable|numeric',
        ];

        if ($this->path() == 'admin/coupons/create') {
            $rules['code'] .= '|unique:coupons,code';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'code.required' => 'Укажите код',
            'code.min' => 'Минимум 6 символов',
            'denomination.numeric' => 'Номинал должен быть числовым',
            'code.max' => 'Максимум 8 символов',
            'denomination.required' => 'Укажите номинал',
            'type.required' => 'Выберите тип',
        ];
    }
}
