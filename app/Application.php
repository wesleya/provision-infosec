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

    protected $fillable = [
        'user_id',
        'type'
    ];

    public function provision($user, $type)
    {
        $provider = $user->provider;
        $result = $provider->vps()->create($type);

        $this->name = $result->name;
        $this->external_id = $result->id;
        $this->provider_id = $provider->id;
        $this->user_id = $user->id;
        $this->type = $type;

        return $this->save();
    }
}
