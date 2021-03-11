<?php

namespace App\Http\Requests\Customer;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class PostOrderRequest extends FormRequest
{
    use FailedValidation;
    /**
     * The attributes usefull for default validation.
     *
     * @var array
     */
    protected const VALIDATION_RULES = [
        'payment_method' => 'required|string|min:35|max:37',
        'shipping_method' => 'required|string|in:0,1',
        'address' => 'required_if:shipping_method,0|string|min:35|max:37',
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
