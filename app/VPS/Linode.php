<?php
namespace App\VPS;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use App\Cloud;
use App\Application;

class Linode implements VPSInterface
{
    const SIZE = 'g6-nanode-1';
    const IMAGE = 'linode/ubuntu16.04lts';

    const SCRIPT_WEBGOAT = 331713;
    const SCRIPT_DVWA = 334281;

    static $scripts = [
        Application::TYPE_WEBGOAT => self::SCRIPT_WEBGOAT,
        Application::TYPE_DVWA => self::SCRIPT_DVWA
    ];

    protected $linode;

    public function __construct($token)
    {
        $adapter = new GuzzleHttpAdapter($token);
        $this->linode = new Cloud\Linode($adapter);
    }

    public function create($type, $accessIP)
    {
        if( !in_array($type, Application::$types) ) {
            throw new \Exception('unknown application type');
        }

        return $this->createLinode($type, $accessIP);
    }

    public function createLinode($type, $accessIP)
    {
        $region = $this->linode->regions()->random()->id;
        $script = self::$scripts[$type];
        $data = new \StdClass();
        $data->ACCESS_IP = $accessIP;

        $result = $this->linode->create(
            self::SIZE,
            self::IMAGE,
            $region,
            $type,
            $script,
            $data
        );

        $result->name = $result->label;

        return $result;
    }
}