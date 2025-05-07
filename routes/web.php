<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('navbar',function(){
    return view('navbar');
    
});

Route::get('about',function(){
    return view('about');

});
Route::get('contact',function(){
    return view('contact');

});
Route::get('profile',function(){
    return view('profile');

});
