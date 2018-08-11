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

    public function provision($provider)
    {
        /**
         * @todo create application based on type
         */
        $result = $provider->cloud()->webgoat();

        $this->name = $result->name;
        $this->external_id = $result->id;
        $this->provider_id = $provider->id;

        return $this->save();
    }
}
