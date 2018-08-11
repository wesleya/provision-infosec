<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application;

class WebApplicationController extends Controller
{
    public function create(Request $request)
    {
        $provider = Auth::user()->find(1)->provider;

        $application = Application::new(
            $request->user(), 
            $request->input('type')
        );

        $result = $application->provision();

        dd($result);
    }
}
