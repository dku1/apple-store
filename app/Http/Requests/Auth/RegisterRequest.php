<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'index' => 'size:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Необходимо указать email',
            'email.unique' => 'Email уже занят',
            'index.size' => '6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
