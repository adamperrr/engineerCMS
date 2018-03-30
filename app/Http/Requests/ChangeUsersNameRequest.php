<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUsersNameRequest extends FormRequest
{

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'name';

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
        ];
    }

    public function messages(){
        return [
            'name.required'=> 'Pole imię jest wymagane',
            'name.min'=> 'Imię musi mieć minimum dwie litery',
        ];
    }
}
