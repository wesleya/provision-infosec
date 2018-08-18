<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Provider;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function index()
    {
        return view('provider/index');
    }
    
    public function create(Request $request)
    {
        $type = $request->input('type');

        switch ($type) {
            case 'linode':
                return $this->redirectLinode();
                break;
            case 'digitalocean':
                return $this->redirectDigitalOcean();
                break;
            default:
                return 'todo: error';
                break;
        }   
    }

    public function store($type)
    {
        $user = Socialite::driver($type)->user();
        $expires = time() + $user->expiresIn;

        $provider = Provider::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'status' => Provider::STATUS_ACTIVE,
            'token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires' => gmdate("Y-m-d H:i:s", $expires)
        ]);

        return redirect('home')->with('success', 'Provider added!');
    }

    protected function redirectLinode()
    {
        $scope = [
            'linodes:read_write', 
            'images:read_write', 
            'stackscripts:read_only'
        ];

        return Socialite::driver('linode')
        ->scopes($scope)
        ->redirect();
    }

    protected function redirectDigitalOcean()
    {
        return Socialite::driver('digitalocean')
        ->scopes(['read write'])
        ->redirect();
    }
}
