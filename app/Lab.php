<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'external_id',
        'provider_id',
        'access_ip',
        'application_id'
    ];

    public function application()
    {
        return $this->hasOne('App\Application');
    }
}
