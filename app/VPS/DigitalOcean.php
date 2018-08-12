<?php
namespace App\VPS;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use DigitalOceanV2\DigitalOceanV2;

class DigitalOcean implements VPSInterface
{
    const SIZE = 's-1vcpu-1gb';

    protected $digitalocean;

    public function __construct($token)
    {
        $adapter = new GuzzleHttpAdapter($token);
        $this->digitalocean = new DigitalOceanV2($adapter);
    }

    public function webGoat()
    {
        $region = $this->getAvailableRegion();
        $size = self::SIZE;
        $image = 'ubuntu-16-04-x64';
        $backups = false;
        $ipv6 = false;
        $privateNetworking = false;
        $sshKeys = ['c3:97:5a:92:c5:dd:56:0c:9c:98:a8:be:f1:b6:b9:c9'];
        $userData = $this->getUserData();
        $monitoring = false;
        $volumes = [];
        $tags = [];
        $name = "web-goat-{$region}-{$size}";

        $result = $this->digitalocean->droplet()->create($name, $region, $size, $image, $backups, $ipv6, $privateNetworking, $sshKeys, $userData);

        return $result;
    }

    protected function getAvailableRegion()
    {
        $regions = $this->digitalocean->region()->getAll();
        $collection = collect($regions);

        $filtered = $collection->filter(function ($value, $key) {
            return in_array(self::SIZE, $value->sizes);
        });

        return $filtered->random()->slug;
    }

    protected function getUserData()
    {
        return "
#cloud-config

runcmd:
  - sudo apt-get update  
  - apt-get install -y apt-transport-https ca-certificates curl software-properties-common
  - curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
  - sudo add-apt-repository \"deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable\"
  - sudo apt-get update
  - sudo apt-get install -y docker-ce
  - docker pull webgoat/webgoat-8.0
  - docker run -p 8080:8080 webgoat/webgoat-8.0 /home/webgoat/start.sh 
  ";
    }
}