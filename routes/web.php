<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::multilingual('/', function () {
    return view('welcome');
});


// Authentication Routes...
Route::multilingual('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::multilingual('login', 'Auth\LoginController@login')->method('post');
Route::multilingual('logout', 'Auth\LoginController@logout')->method('post');

// Registration Routes...
Route::multilingual('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::multilingual('register', 'Auth\RegisterController@register')->method('post');

// Password Reset Routes...
Route::multilingual('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::multilingual('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->method('post');
Route::multilingual('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::multilingual('password/reset', 'Auth\ResetPasswordController@reset')->method('post');

Route::get('/home', 'HomeController@index')->name('home');
