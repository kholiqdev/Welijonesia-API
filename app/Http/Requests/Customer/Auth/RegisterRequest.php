<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use FailedValidation;

    /**
     * The attributes usefull for default validation.
     *
     * @var array
     */
    protected const VALIDATION_RULES = [
        'name' => 'required|string|min:3',
        'gender' => 'required|string|max:1|in:L,P',
        'phone' => 'required|numeric|min:10',
        'email' => 'required|string|email|min:5|unique:users',
        'password' => 'required|string|max:255|min:6|confirmed',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::VALIDATION_RULES;
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email sudah terdaftar.',
        ];
    }
}
