<?php

namespace App\Validators;

use Ygreis\Validator\AbstractValidator;

class TestTwoValidator extends AbstractValidator
{
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'mother_name' => 'nullable|string|max:5'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'mother_name' => 'Mother name',
        ];
    }
}
