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
    return view('home');
})->middleware('home');


// Registration Routes...
Route::multilingual('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::multilingual('register', 'Auth\RegisterController@register')->method('post');


// Password Reset Routes...
Route::multilingual('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::multilingual('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->method('post');
Route::multilingual('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::multilingual('password/reset', 'Auth\ResetPasswordController@reset')->method('post');


// Pro routes
Route::name('pro.')->group(function () {

  Route::middleware('auth_is_pro')->group(function () {
    Route::multilingual('pro', 'Pro\IndexController@index')->name('home');
  });

  Route::multilingual('pro/login', 'Pro\LoginController@showLoginForm')->name('login');
  Route::multilingual('pro/login', 'Pro\LoginController@login')->method('post')->name('login');
  Route::multilingual('pro/logout', 'Pro\LoginController@logout')->method('post')->name('logout');
});


// Tourist routes
Route::name('tourist.')->group(function () {

  Route::middleware('auth_is_tourist')->group(function () {
    Route::multilingual('tourist', 'Tourist\IndexController@index')->name('home');
  });

  Route::multilingual('tourist/login', 'Tourist\LoginController@showLoginForm')->name('login');
  Route::multilingual('tourist/login', 'Tourist\LoginController@login')->method('post')->name('login');
  Route::multilingual('tourist/logout', 'Tourist\LoginController@logout')->method('post')->name('logout');
  Route::multilingual('tourist/publish', 'Tourist\ProjectController@publish')->name('publish');
});
