<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class OathDigitalOceanController extends Controller
{
    public function index()
    {
        $user = Socialite::driver('digitalocean')->user();
        $expires = time() + $user->expiresIn;

        $provider = Provider::create([
            'user_id' => Auth::id(),
            'type' => Provider::TYPE_DIGITALOCEAN,
            'status' => Provider::STATUS_ACTIVE,
            'token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires' => gmdate("Y-m-d H:i:s", $expires)
        ]);

        dd($user);
    }

    public function create()
    {
        return Socialite::driver('digitalocean')
            ->scopes(['read write'])
            ->redirect();
    }
}
