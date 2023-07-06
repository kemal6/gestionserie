<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUsersRequest extends FormRequest
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
        return [
            'nom' => ['required','regex:/^[\w-]*$/'],
            'email' => ['required','email','unique:users'], // doit etre fmt email
            'password' => ['required','between:4,50'] // min 4 carac
            // 'autre' => ['required','regex:/^[0-9a-z\-]*$/','unique:designation']
        ];
    }
}
