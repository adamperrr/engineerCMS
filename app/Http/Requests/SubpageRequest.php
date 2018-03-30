<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubpageRequest extends FormRequest
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
            'title' => 'required|max:255',
            'titleVisibility' => '',
            'description' => '',
            'descVisibility' => '',
            'type' => 'required',
            'content' => ''
        ];
    }

    public function messages(){
        return [
            'title.required'=> 'Pole tytuł jest wymagane',
            'type.required'=> 'Pole typ jest wymagane'
        ];
    }
}
