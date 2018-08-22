<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\VPS\DigitalOcean;

class MonitorDigitalOcean extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'monitor:digitalocean 
    {--id= : ID of droplet to monitor}
    {--token= : Access token to authorize API request}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $id = $this->option('id');
        $digitalocean = new DigitalOcean($token);

        while(true) {
            $status = $digitalocean->status($id);
            $this->info($status);
            sleep(2);
        }
    }
}
