<?php
namespace App\Cloud;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;

class Linode
{
    const ENDPOINT = 'https://api.linode.com/v4/';

    /**
     * @var GuzzleHttpAdapter
     */
    protected $adapter;

    public function __construct($token)
    {
        $this->adapter = new GuzzleHttpAdapter($token);
    }

    public function regions()
    {
        $endpoint = self::ENDPOINT . 'regions';

        $result = $this->adapter->get($endpoint);

        return json_decode($result);
    }
}