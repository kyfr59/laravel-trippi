<?php

namespace App\Http\Controllers\Pro;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Pro Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating professionals for the application
    | and redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('pro.login');
    }


    /**
     * Authentificate the tourist and redirect
     *
     * @return void
     */
    public function login(Request $request)
    {
        $input = $request->all();

        $messages = [
              'email.required' => __("The e-mail address is required"),
              'email.email' => __("The e-mail address is incorrect"),
              'password.required' => __("The password is required"),
              'password.min' => 'The password must contain at least 8 characters',
            ];


        $v = $this->validate(
            $request,
            [
              'email' => 'required|email',
              'password' => 'required|min:8',
            ],
            $messages
        );

        if (auth()->attempt(
            [
              'email' => $input['email'],
              'password' => $input['password'],
              'type' => User::PRO
            ]
        )) {
          return redirect(localized_route('pro.home'));
        } else {
          return redirect(localized_route('pro.login'))
                ->with('error', __("Incorrect e-mail address or password"))
                ->withInput()->exceptInput('password');
        }
    }
}
