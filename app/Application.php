<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    const TYPE_WEBGOAT = 1;

    protected $user;

    protected $fillable = [
        'user_id',
        'type'
    ];

    public static function new($user, $type)
    {
        $app = new Application();

        $app->type = $type;
        $app->user = $user;

        return $app;
    }

    public function provision()
    {
        /**
         * @todo create application based on type
         */
        $provider = $this->user->find(1)->provider;
        $result = $provider->cloud()->webgoat();

        $this->name = $result->name;
        $this->external_id = $result->id;
        $this->provider_id = $provider->id;
        $this->user_id = $this->user->id;

        return $this->save();
    }
}
