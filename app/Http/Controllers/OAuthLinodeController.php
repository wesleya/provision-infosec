<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthLinodeController extends Controller
{
    public function index()
    {
        $user = Socialite::driver('linode')->user();

        dd($user);
    }

    public function create()
    {
        return Socialite::driver('linode')
            ->scopes(['linodes:read_write', 'images:read_write', 'stackscripts:read_only'])
            ->redirect();
    }
}
