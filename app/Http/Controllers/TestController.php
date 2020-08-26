<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

     public function index()
    {
       return view('test');
    }
}
