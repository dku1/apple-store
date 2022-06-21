<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required',
            'img' => 'image:jpg, jpeg, png',
            'preview' => 'required|max:200',
            'description' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите название',
            'preview.required' => 'Укажите превью',
            'img.image' => 'Изображение не соответствует формату',
            'category_id.required' => 'Выберите категорию',
            'preview.max' => 'Превью максимум 100 символов',
            'description.required' => 'Необходимо описание',
            'price.required' => 'Укажите цену',
        ];
    }
}
