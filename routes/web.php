<?php

use Illuminate\Support\Facades\Route;
use http\Client\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (\App\Http\Requests\TestRequest $request) {
    $validate = makeValidator(\App\Validators\TestValidator::class, $request->all());
    dd($validate->errors()->getMessages());



    dd('Success validation', $request->all());
    $validate = app()->make(\App\Validators\TestValidator::class)->validateFails($request->all());
    dd($validate, $request->all());
});
