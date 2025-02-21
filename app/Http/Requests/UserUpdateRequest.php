<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// ユーザー情報更新時に入力する内容のバリデーションルール記載
class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
