<?php
namespace App\VPS;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use DigitalOceanV2\DigitalOceanV2;
use Illuminate\Support\Facades\Storage;

class DigitalOcean implements VPSInterface
{
    const SIZE = 's-1vcpu-1gb';

    protected $digitalocean;

    public function __construct($token)
    {
        $adapter = new GuzzleHttpAdapter($token);
        $this->digitalocean = new DigitalOceanV2($adapter);
    }

    public function webgoat()
    {
        $userData = Storage::get('scripts/webgoat.sh');
        $type = "webgoat";

        return $this->createDroplet($type, $userData);
    }

    public function dvwa()
    {
        $userData = Storage::get('scripts/dvwa.sh');
        $type = "dv-web-app";

        return $this->createDroplet($type, $userData);
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

    protected function createDroplet($type, $userData)
    {
        $size = self::SIZE;
        $image = 'ubuntu-16-04-x64';
        $name = "{$type}-{$size}";
        $region = $this->getAvailableRegion();

        $result = $this->digitalocean->droplet()->create(
            $name,
            $region,
            $size,
            $image,
            false, // backups
            false, // ipv6
            false, // private networking
            ['c3:97:5a:92:c5:dd:56:0c:9c:98:a8:be:f1:b6:b9:c9'], // ssh keys
            $userData
        );

        return $result;
    }
}