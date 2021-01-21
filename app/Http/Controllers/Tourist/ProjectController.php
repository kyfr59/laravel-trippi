<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Project Controller
    |--------------------------------------------------------------------------
    */

    /**
     * - Show the project publication page
     * - Register a project
     * - Redirect to identification page if the user is not logged in
     *
     * @return \Illuminate\View\View
     */
    public function publish(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('get')) {

            if ($user &&
                $user->type == User::TOURIST &&
                $request->session()->has('project')
            ) {

                // Store the project from session
                echo "Stockage de : ".$request->session()->get('project')['destination'];

                // Destroy the project in session
                $request->session()->forget('project');

            } else {

                // Show the project form
                return view('tourist.publish');
            }

        } else { // Post method

            if ($user &&
                $user->type == User::TOURIST
            ) {

                // Store the project from POST data
                echo "Stockage en base de : ".$request->all()['destination'];

            } else {

                // Store the project data in session
                $request->session()->put('project', $request->all());

                // Show identification form (second form of proj)
                return redirect(localized_route('tourist.identification'));
            }
        }
    }


    /**
     * - Show the identification page (second step of the publication process if the user is not logged in)
     *
     * @return \Illuminate\View\View
     */
    public function identification(Request $request)
    {
        return view('tourist.identification');
    }
}
