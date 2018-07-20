<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use DigitalOceanV2\DigitalOceanV2;

class DigitalOceanWebGoat extends Command
{
    const SIZE = 's-1vcpu-1gb';

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

        $result = $digitalocean->droplet()->create($name, $region, $size, $image, $backups, $ipv6, $privateNetworking, $sshKeys, $userData);

        dd($result);
    }

    protected function getAvailableRegion(DigitalOceanV2 $digitalocean)
    {
        $regions = $digitalocean->region()->getAll();
        $collection = collect($regions);

        $filtered = $collection->filter(function ($value, $key) {
            return in_array(self::SIZE, $value->sizes);
        });

        return $filtered->random()->slug;
    }

    /**
     * @todo convert this to a bash script so it can be used for other providers
     * @todo put it somewhere where it can be accessed by all providers
     *
     * @return string
     */
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
