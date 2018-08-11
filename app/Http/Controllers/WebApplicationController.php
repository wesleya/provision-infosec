<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application;

class WebApplicationController extends Controller
{
    public function create(Request $request)
    {
        $type = $request->input('type');
        $provider = Auth::user()->find(1)->provider;
        $application = new Application([
            'type' => $type,
            'user_id' => Auth::id()
        ]);



        $result = $application->provision($provider);
        // and then inside provision() function
        // $result = $provider->cloud()->webgoat();
        // and then save application

        /*
        $provider = Auth::user()->find(1)->provider;
        $application = $request->input('application');

        $result = $provider->provision($application);
        */

        dd($result);
    }
}
