<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    const TYPE_DIGITALOCEAN = 1;
    const TYPE_LINODE = 2;

    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'token',
        'refresh_token',
        'expires'
    ];
}
