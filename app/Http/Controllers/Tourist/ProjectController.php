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
              'destination.required'    => __("The destination is required"),
              'date_start.required'     => __("The start date is required"),
              'date_start.date_format'  => __("The start date is invalid"),
              'date_end.required'       => __("The end date is required"),
              'date_end.date_format'    => __("The end date is invalid"),
              'date_end.after_or_equal' => __("The end date must come after the date start"),
              'email.required'          => __("The e-mail address is required"),
              'email.email'             => __("The e-mail address is invalid"),
            ];


            $date_format = $request->get('lang') == 'fr' ? 'd/m/Y' : 'm/d/Y';

            $rules = ['destination'      => 'required',
                      'ville'            => 'required',
                      'latitude'         => 'required',
                      'longitude'        => 'required',
                      'code_departement' => 'required',
                      'date_start'       => 'required|date_format:"'.$date_format.'"',
                      'date_end'         => 'required|date_format:"'.$date_format.'"|after_or_equal:date_start',
                      'email'            => 'required|email',
                    ];

            if ($user) unset($rules['email']);

            $v = $this->validate(
                $request,
                $rules,
                $messages
            );

            if ($user &&
                $user->type == User::TOURIST
            ) {

                $date_start = calendar_to_timestamp($request->get('date_start'), $request->get('lang'));
                $date_end   = calendar_to_timestamp($request->get('date_end'), $request->get('lang'));

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
