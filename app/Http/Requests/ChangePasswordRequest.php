<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'password';

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
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirm' => 'required|same:new_password',
        ];
    }

    public function messages(){
        return [
            'old_password.required'=> 'Pole starego hasła jest wymagane',
            'new_password.required'=> 'Pole nowego hasła jest wymagane',
            'password_confirm.required'=> 'Pole potwierdzenia hasła jest wymagane',
            'password_confirm.same'=> 'Hasło i jego potwierdzenie muszą mieć identyczne wartości',
        ];
    }
}
