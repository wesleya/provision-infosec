<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VPS\DigitalOcean;
use App\VPS\Linode;

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

    public function vps()
    {
        switch ($this->type) {
            case self::TYPE_DIGITALOCEAN:
                $vps = new DigitalOcean($this->token);
                break;
            case self::TYPE_LINODE:
                $vps = new Linode($this->token);
                break;
        }

        return $vps;
    }
}
