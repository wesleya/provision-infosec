<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use DigitalOceanV2\DigitalOceanV2;

class DigitalOceanWebGoat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provision:web-goat {--api-key=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provision Web Goat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $key = $this->option('api-key');

        $adapter = new GuzzleHttpAdapter($key);
        $digitalocean = new DigitalOceanV2($adapter);

        $region = $this->getAvailableRegion($digitalocean);
        $size = 's-1vcpu-1gb';
        $image = 'ubuntu-16-04-x64';
        $backups = false;
        $ipv6 = false;
        $privateNetworking = false;
        $sshKeys = [];
        $userData = '';
        $monitoring = false;
        $volumes = [];
        $tags = [];
        $name = "web-goat-{$region}-{$size}";

        $droplet = $digitalocean->droplet();
        $result = $droplet->create($name, $region, $size, $image);

        dd($result);
    }

    protected function getAvailableRegion(DigitalOceanV2 $digitalocean)
    {
        $regions = $digitalocean->region()->getAll();
        $collection = collect($regions);

        $filtered = $collection->filter(function ($value, $key) {
            return in_array('s-1vcpu-1gb', $value->sizes);
        });

        return $filtered->random()->slug;
    }
}
