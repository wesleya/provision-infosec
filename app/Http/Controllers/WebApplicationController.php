<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebApplicationController extends Controller
{
    public function create(Request $request)
    {
        $provider = Auth::user()->find(1)->provider;
        $application = $request->input('application');

        $result = $provider->provision($application);
        

        dd($result);
    }
}
