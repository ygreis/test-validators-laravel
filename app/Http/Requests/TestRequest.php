<?php

namespace App\Http\Requests;

use App\Validators\TestValidator;
use Ygreis\Validator\AbstractRequest;

class TestRequest extends AbstractRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.age' => 'nullable|integer|min:18|max:120',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user.age' => 'User Age',
        ];
    }

    public function validators()
    {
        return [TestValidator::class];
    }

}
