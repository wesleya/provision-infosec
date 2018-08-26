<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'user_id',
        'type'
    ];

    public function application()
    {
        return $this->hasOne('App\Application');
    }

    public function provision($user, $data)
    {
        $provider = $user->provider;
        $application = Application::find($data['type']);
        $accessIP = $data['ip'];

        $result = $provider->vps()->create($application, $accessIP);

        $this->name = $result->name;
        $this->external_id = $result->id;
        $this->provider_id = $provider->id;
        $this->user_id = $user->id;
        $this->application_id = $application->id;
        $this->access_ip = $accessIP;

        return $this->save();
    }
}
