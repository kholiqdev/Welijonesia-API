<?php

namespace App\Http\Requests\Customer;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class GetVillageRequest extends FormRequest
{
    use FailedValidation;
    /**
     * The attributes usefull for default validation.
     *
     * @var array
     */
    protected const VALIDATION_RULES = [
        'id' => 'integer|min:9',
        'district' => 'required_without:id|integer|min:7',
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
