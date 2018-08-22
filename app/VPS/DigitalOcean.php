<?php
namespace App\VPS;

use App\Application;
use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use DigitalOceanV2\DigitalOceanV2;
use Illuminate\Support\Facades\Storage;

class DigitalOcean implements VPSInterface
{
    const SIZE = 's-1vcpu-1gb';
    const IMAGE = 'ubuntu-16-04-x64';

    protected $digitalocean;

    public function __construct($token)
    {
        $adapter = new GuzzleHttpAdapter($token);
        $this->digitalocean = new DigitalOceanV2($adapter);
    }

    public function status($id)
    {
        $result = $this->digitalocean->droplet()->getById($id);

        return $result->status;
    }

    public function create($type)
    {
        if( !in_array($type, Application::$types) ) {
            throw new \Exception('unknown application type');
        }

        return $this->createDroplet($type);
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

    protected function createDroplet($type)
    {
        $region = $this->getAvailableRegion();
        $userData = Storage::disk('scripts')->get("{$type}.sh");

        $result = $this->digitalocean->droplet()->create(
            $type, // name
            $region,
            self::SIZE,
            self::IMAGE,
            false, // backups
            false, // ipv6
            false, // private networking
            ['c3:97:5a:92:c5:dd:56:0c:9c:98:a8:be:f1:b6:b9:c9'], // ssh keys
            $userData
        );

        return $result;
    }
}