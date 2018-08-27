<?php
namespace App\VPS;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use App\Cloud;
use App\Application;

class Linode implements VPSInterface
{
    const SIZE = 'g6-nanode-1';
    const IMAGE = 'linode/ubuntu16.04lts';

    protected $linode;

    public function __construct($token)
    {
        $adapter = new GuzzleHttpAdapter($token);
        $this->linode = new Cloud\Linode($adapter);
    }

    public function create($application, $accessIP)
    {
        $region = $this->linode->regions()->random()->id;
        $data = $this->getData($accessIP);

        $result = $this->linode->create(
            self::SIZE,
            self::IMAGE,
            $region,
            $application->label,
            $application->stackscript,
            $data
        );

        $result->name = $result->label;

        return $result;
    }

    protected function getData($accessIP)
    {
        $data = new \StdClass();
        $data->access_ip = $accessIP;

        return $data;
    }
}