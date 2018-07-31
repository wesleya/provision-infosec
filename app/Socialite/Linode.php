<?php
namespace App\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class Linode extends AbstractProvider implements ProviderInterface
{
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://login.linode.com/oauth/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://login.linode.com/oauth/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.linode.com/v4/profile', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'       => $user['uid'],
            'nickname' => $user['username'],
            'email'    => $user['email']
        ]);
    }
}