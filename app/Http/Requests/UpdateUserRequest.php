<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|min:2',
            'email' => 'required|email',
            'role' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=> 'Pole imię jest wymagane',
            'name.min'=> 'Imię musi mieć minimum dwie litery',

            'email.required'=> 'Pole e-mail jest wymagane',
            'email.email'=> 'Adres e-mail jest niepoprawny',

            'role.required'=> 'Pole rola jest wymagane',
        ];
    }
}
