<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// ユーザー情報登録時に入力する内容のバリデーションルール記載
class UserStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name_kana' => ['required', 'string', 'max:255'],
            'first_name_kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'gender' => ['required', 'string'],
            'birth_year' => ['required', 'integer', 'min:1950', 'max:' . date('Y')],
            'birth_month' => ['required', 'integer', 'min:1', 'max:12'],
            'birth_day' => ['required', 'integer', 'min:1', 'max:31'],
            'join_year' => ['required', 'integer', 'min:1990', 'max:' . date('Y')],
            'join_month' => ['required', 'integer', 'min:1', 'max:12'],
            'join_day' => ['required', 'integer', 'min:1', 'max:31'],
            'post_code' => ['required', 'string', 'max:7', 'regex:/^\d{7}$/'],
            'address1' => ['required', 'string'],
            'address2' => ['required', 'string'],
            'address3' => ['required', 'string'],

        ];
    }


    public function messages(): array
    {
        return [
            'post_code.regex' => '郵便番号は7桁の数字のみ入力してください。',
        ];
    }
}
