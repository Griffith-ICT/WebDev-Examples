<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('greetingForm');
});

Route::post('greeting', function () {
    $name = request("name");
    $age = request("age");
    return view('greeting')->with('user', $name)->with('age', $age + 1);
});


Route::get('user/{name}', function ($name){
    return "Hello $name";
});