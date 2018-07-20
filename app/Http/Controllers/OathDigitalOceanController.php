<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OathDigitalOceanController extends Controller
{
    public function index()
    {
        $user = Socialite::driver('digitalocean')->user();

        dd($user);
    }

    public function create()
    {
        return Socialite::driver('digitalocean')->redirect();
    }
}
