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

                // If a project exists in session, fill the form with session data
                if ($request->session()->has('project')) {

                  $project = $request->session()->get('project');
                  $request->session()->forget('project');
                  return redirect(localized_route('tourist.publish'))->withInput($project);
                }

                // Show the project form
                return view('tourist.publish');
            }

        } else { // Post method

            $messages = [
              'destination.required'  => __("The destination is required"),
              'date_debut.required'   => __("The start date is required"),
              'date_fin.required'     => __("The end date is required"),
              'email.required'        => __("The e-mail address is required"),
              'email.email'           => __("The e-mail address is invalid"),
            ];

            $v = $this->validate(
                $request,
                [
                  'destination'      => 'required',
                  'ville'            => 'required',
                  'latitude'         => 'required',
                  'longitude'        => 'required',
                  'code_departement' => 'required',
                  'date_debut'       => 'required',
                  'date_fin'         => 'required',
                  'email'            => 'required|email',
                ],
                $messages
            );

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
        if (!$request->session()->has('project')) {
          return back();
        }

        $project = $request->session()->get('project');

        return view('tourist.identification', ['email' => $project['email']]);
    }
}
