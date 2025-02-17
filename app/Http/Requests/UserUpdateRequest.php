<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => ['nullable', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name_kana' => ['nullable', 'string', 'max:255'],
            'first_name_kana' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'join_date' => ['nullable', 'date'],
            'post_code' => ['nullable', 'string', 'max:7', 'regex:/^\d{7}$/'],
            'address1' => ['nullable', 'string'],
            'address2' => ['nullable', 'string'],
            'address3' => ['nullable', 'string'],
            'role' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'post_code.regex' => '郵便番号は7桁の数字のみ入力してください。',
        ];
    }
}
