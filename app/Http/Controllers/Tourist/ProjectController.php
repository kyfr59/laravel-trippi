<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Project Controller
    |--------------------------------------------------------------------------
    */

    /**
     * Show the project publication page
     *
     * @return \Illuminate\View\View
     */
    public function publish()
    {
        return view('tourist.publish');
    }
}
