<?php

namespace App\Http\Requests\User\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GenerateSynopsisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'author_profile_id' => 'required|exists:custom_author_profiles,id',
            'purpose' => 'required|string|max:1000',
            'target_audience' => 'required|string|max:1000',
            'language' => 'required|in:English,German',
        ];
        return $rules;
    }
}
