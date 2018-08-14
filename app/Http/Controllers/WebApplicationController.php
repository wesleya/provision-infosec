<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessProvision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application;

class WebApplicationController extends Controller
{
    public function create(Request $request)
    {
        $type = $request->input('type');
        $user = $request->user();

        ProcessProvision::dispatch($user, $type);
    }
}
