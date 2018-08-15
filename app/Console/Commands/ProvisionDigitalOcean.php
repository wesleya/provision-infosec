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
    {--webgoat : Provision WebGoat on DigitalOcean}
    {--dv-web-app : Provision WebGoat on DigitalOcean} 
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
        $digitalocean = new DigitalOcean($token);

        if( $this->option('webgoat') ) {
            $result = $digitalocean->webGoat();
        } elseif( $this->option('dv-web-app') ) {
            $result = $digitalocean->dvWebApp();
        } else {
            dd('application type required');
        }

        dd($result);
    }
}
