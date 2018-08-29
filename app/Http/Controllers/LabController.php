<?php

namespace App\Http\Controllers;

use App\Lab;
use App\Application;
use App\Jobs\DeployLab;
use App\Http\Requests\StoreLab;

class LabController extends Controller
{
    public function create($id)
    {
        $content = ['application' => Application::find($id)];

        return view('lab/create', $content);
    }

    public function store(StoreLab $request)
    {
        $user = $request->user();
        $application = Application::find($request->input('type'));
        $lab = Lab::create(['access_ip' => $request->input('ip')]);

        DeployLab::dispatch($user, $application, $lab);
        return redirect('home')->with('success', 'Application building!');
    }
}
