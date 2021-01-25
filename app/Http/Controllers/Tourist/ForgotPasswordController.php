<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Brokers\TouristPasswordBroker;
use Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

     /**
     * Overload trait function in order to display tourist reset form
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('tourist.password');
    }


    /**
     * Overload trait function in order to add the tourist type to credentials
     *
     * @return \Illuminate\View\View
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only('email');
        $credentials['type'] = User::TOURIST;
        return $credentials;
    }
}
