<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessProvision;
use Illuminate\Http\Request;

class WebApplicationController extends Controller
{
    public function create($type)
    {
        $content = ['type' => $type];

        return view('application/create', $content);
    }

    public function store(Request $request)
    {
        $type = $request->input('type');
        $user = $request->user();

        ProcessProvision::dispatch($user, $type);
        return redirect('home')->with('success', 'Application building!');
    }
}
