<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\VPS\Linode;

class ProvisionLinode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provision:linode 
    {--app= : The app to provision on Linode} 
    {--token= : Access token to authorize API request}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provision web application on Linode';

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

        $linode = new Linode($token);

        if($app == 'webgoat') {
            $result = $linode->webgoat();
        } else {
            dd('invalid app');
        }

        dd($result);
    }
}
