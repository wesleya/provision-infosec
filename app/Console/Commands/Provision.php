<?php

namespace App\Console\Commands;

use App\Provision\DigitalOcean;
use App\Provision\Linode;
use App\Provision\ProvisionInterface;
use Illuminate\Console\Command;

class Provision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provision:web-goat {--provider=} {--token=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provision Web Application';

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
        $token = $this->option('token');
        $provider = $this->option('provider');
        $provision = $this->getProvision($provider, $token);

        $result = $provision->webGoat();

        dd($result);
    }

    /**
     * @param $provider
     * @param $token
     * @return ProvisionInterface
     */
    protected function getProvision($provider, $token)
    {
        switch ($provider) {
            case 'digitalocean':
                $provision = new DigitalOcean($token);
                break;
            case 'linode':
                $provision = new Linode($token);
                break;
        }

        return $provision;
    }
}