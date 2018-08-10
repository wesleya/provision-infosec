<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Provider;
use Illuminate\Support\Facades\Auth;

class OAuthLinodeController extends Controller
{
    public function index()
    {
        $user = Socialite::driver('linode')->user();

        $expires = time() + $user->expiresIn;

        $provider = Provider::create([
            'user_id' => Auth::id(),
            'type' => Provider::TYPE_LINODE,
            'status' => Provider::STATUS_ACTIVE,
            'token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires' => gmdate("Y-m-d H:i:s", $expires)
        ]);

        dd($user);
    }

    public function create()
    {
        return Socialite::driver('linode')
            ->scopes(['linodes:read_write', 'images:read_write', 'stackscripts:read_only'])
            ->redirect();
    }
}
