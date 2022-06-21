<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required',
            'img' => 'image:jpg, jpeg, png',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите название',
            'img.image' => 'Изображение не соответствует формату',
            'description.required' => 'Необходимо описание',
        ];
    }
}
