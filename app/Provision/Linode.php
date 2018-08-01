<?php
namespace App\Provision;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;

class Linode
{
    public function __construct($token)
    {
        $adapter = new GuzzleHttpAdapter($token);
    }

    public function webGoat()
    {

    }
}