<?php

namespace Ygreis\Validator;

use Illuminate\Validation\Validator;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Container\Container;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Ygreis\Validator\Interfaces\AbstractValidatorInterface;
abstract class AbstractValidator implements AbstractValidatorInterface
{

    use ValidatesWhenResolvedTrait;

    /**
     * The container instance.
     *
     * @var Container
     */
    private $container;

    /**
     * Data that will be validated
     *
     * @var array
     */
    protected $data = [];

    /**
     * Validator constructor.
     *
     * @param Container $container
     * @param bool $throwWithException
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @param array $data
     * @return Validator
     * @throws ValidationException
     */
    public function validate(array $data): Validator
    {
        $this->data = $data;
        $instance = $this->getValidatorInstance();
        if (! $instance->passes()) {
            $this->failedValidation($instance);
        }
        return $instance;
    }
    public function validateFails(array $data, $failsWithException = false): Validator
    {
        try {
            return $this->validate($data);
        } catch (ValidationException $exception) {
            return $exception->validator;
        }
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getValidatorInstance()
    {
        $factory = $this->container->make(ValidationFactory::class);
        $validator = $this->createDefaultValidator($factory);

        if (method_exists($this, 'withValidator')) {
            $this->withValidator($validator);
        }

        return $validator;
    }

    /**
     * Create the default validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Factory $factory
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        return $factory->make(
            $this->data,
            $this->container->call([$this, 'rules']),
            $this->messages(),
            $this->attributes()
        );
    }
}
