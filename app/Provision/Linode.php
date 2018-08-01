<?php
namespace App\Provision;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use App\Cloud;

class Linode implements ProvisionInterface
{
    const SIZE = 'g6-nanode-1';
    const IMAGE = 'linode/ubuntu16.04lts';

    protected $linode;

    public function __construct($token)
    {
        $adapter = new GuzzleHttpAdapter($token);
        $this->linode = new Cloud\Linode($adapter);
    }

    public function webGoat()
    {
        $region = $this->linode->regions()->random()->id;
/*
        $images = $this->linode->images();

        $filtered = $images->filter(function ($value, $key) {
            return $value->deprecated == false && $value->is_public == true;
        });

        dd($filtered);
*/

        $result = $this->linode->create(self::SIZE, self::IMAGE, $region);

        return $result;
    }
}