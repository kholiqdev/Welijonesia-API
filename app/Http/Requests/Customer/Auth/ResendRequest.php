<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ResendRequest extends FormRequest
{
    use FailedValidation;

    /**
     * The attributes usefull for default validation.
     *
     * @var array
     */
    protected const VALIDATION_RULES = [
        'via' => 'required|string|in:email,phone',
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
}
