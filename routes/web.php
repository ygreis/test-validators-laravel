<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (\App\Http\Requests\TestRequest $request) {

    dd('Request validation completed successfully!', $request->all());

});

Route::get('/test-validations-error', function (Request $request) {

    /**
     * @var \Illuminate\Validation\Validator $validate
     */
    $validate = app()->make(\App\Validators\TestValidator::class)->validateFails($request->all());

    dd($validate->messages()->all());

    // To avoid documentation and the like as shown above, you can create a global function and use it.

    $validateMake = makeValidator(\App\Validators\TestValidator::class);

    dd($validateMake->messages()->all());
});
