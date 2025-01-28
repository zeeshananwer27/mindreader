<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        $rules = [  
            'name' => 'required|max:255|unique:languages,name'
        ];
        return $rules;
    }

    public function messages()
    {
         return [
            'name.required' => translate('The Name Feild is Required'),
            'name.unique'   => translate('The Name Must Be Unique'),
         ];
    }
}
