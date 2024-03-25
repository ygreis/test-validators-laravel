<?php

namespace App\Http\Requests;
use App\Validators\TestValidator;
use Illuminate\Foundation\Http\FormRequest;
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function validators()
    {
        return [TestValidator::class];
    }

}
