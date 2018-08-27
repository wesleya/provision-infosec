<?php

namespace App\Http\Controllers;

use App\Lab;
use App\Application;
use App\Jobs\DeployLab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function create($id)
    {
        $content = ['application' => Application::find($id)];

        return view('lab/create', $content);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $application = Application::find($request->input('type'));
        $lab = Lab::create([
            'access_ip' => $request->input('ip')
        ]);

        DeployLab::dispatch($user, $application, $lab);
        return redirect('home')->with('success', 'Application building!');
    }
}
