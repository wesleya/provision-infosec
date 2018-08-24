<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    const TYPE_WEBGOAT = 'webgoat';
    const TYPE_DVWA = 'dvwa';

    static $types = [
        self::TYPE_WEBGOAT,
        self::TYPE_DVWA
    ];

    static $names = [
        self::TYPE_WEBGOAT => 'Web Goat',
        self::TYPE_DVWA => 'Damn Vulnerable Web App'
    ];

    protected $fillable = [
        'user_id',
        'type'
    ];

    public function provision($user, $type, $accessIP)
    {
        $provider = $user->provider;
        $result = $provider->vps()->create($type, $accessIP);

        $this->name = $result->name;
        $this->external_id = $result->id;
        $this->provider_id = $provider->id;
        $this->user_id = $user->id;
        $this->type = $type;
        $this->access_ip = $accessIP;

        return $this->save();
    }
}
