<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'city' => 'required',
            'address' => 'required',
            'index' => 'required|size:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Необходимо указать email',
            'city.required' => 'Необходимо указать город',
            'address.required' => 'Необходимо указать адрес',
            'index.required' => 'Необходимо указать индекс',
            'index.size' => 'Индекс содержит 6 символов',
        ];
    }
}
