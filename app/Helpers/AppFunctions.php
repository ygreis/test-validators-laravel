<?php
/*
|--------------------------------------------------------------------------
| Functions APP
|--------------------------------------------------------------------------
| Here is where are all the APP functions
| practical functions are used throughout the project to facilitate usability.
|
*/

use Ygreis\Validator\AbstractValidator;

if (! function_exists('makeValidator'))
{
    /**
     * @param $abstract
     * @param array $data
     * @param array $parameters
     * @return \Illuminate\Validation\Validator
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function makeValidator($abstract, array $data = [], array $parameters = []): \Illuminate\Validation\Validator
    {
        return app()->make($abstract, $parameters)->validateFails($data ?? request()->all());
    }
}
