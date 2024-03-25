<?php

namespace App\Validators;
use Ygreis\Validator\AbstractValidator;

class TestValidator extends AbstractValidator
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
            'name' => 'required|string',
            'age' => 'nullable|integer|min:18|max:120',
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
            'name' => 'Nome',
            'age' => 'Idade',
        ];
    }
}
