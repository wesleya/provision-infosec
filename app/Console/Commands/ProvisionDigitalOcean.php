<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\VPS\DigitalOcean;

class ProvisionDigitalOcean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provision:digitalocean 
    {--app= : The app to provision on DigitalOcean} 
    {--token= : Access token to authorize API request}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provision web application on DigitalOcean';

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
        $app = $this->option('app');

        $digitalocean = new DigitalOcean($token);

        if($app == 'webgoat') {
            $result = $digitalocean->webGoat();
        } else {
            dd('invalid app');
        }

        dd($result);
    }
}
