<?php

namespace App\Http\Controllers;

use App\Jobs\DeployLab;
use Illuminate\Http\Request;
use App\Application;

class LabController extends Controller
{
    public function create($id)
    {
        $content = ['application' => Application::find($id)];

        return view('lab/create', $content);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = $request->user();

        DeployLab::dispatch($user, $data);
        return redirect('home')->with('success', 'Application building!');
    }
}
