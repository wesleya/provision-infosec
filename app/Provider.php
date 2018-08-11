<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provision\DigitalOcean;
use App\Provision\Linode;

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

    public function cloud()
    {
        switch ($this->type) {
            case self::TYPE_DIGITALOCEAN:
                $provision = new DigitalOcean($this->token);
                break;
            case self::TYPE_LINODE:
                $provision = new Linode($this->token);
                break;
        }

        return $provision;
    }
}
