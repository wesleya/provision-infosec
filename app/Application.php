<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    const TYPE_WEBGOAT = 1;

    protected $fillable = [
        'user_id',
        'type'
    ];

    public function provision($user, $type)
    {
        /**
         * @todo create application based on type
         */
        $provider = $user->find(1)->provider;
        $result = $provider->vps()->webgoat();

        $this->name = $result->name;
        $this->external_id = $result->id;
        $this->provider_id = $provider->id;
        $this->user_id = $user->id;
        $this->type = $type;

        return $this->save();
    }
}
