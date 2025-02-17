<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name_kana' => ['required', 'string', 'max:255'],
            'first_name_kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'gender' => ['required', 'string'],
            // 'birth_day' => ['required', 'date'],
            'birth_year' => ['required', 'integer','min:1950','max:'.date('Y')],
            'birth_month' => ['required', 'integer','min:1','max:12'],
            'birth_day' => ['required', 'integer','min:1','max:31'],
            'join_year' => ['required', 'integer','min:1990','max:'.date('Y')],
            'join_month' => ['required', 'integer','min:1','max:12'],
            'join_day' => ['required', 'integer','min:1','max:31'],
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
