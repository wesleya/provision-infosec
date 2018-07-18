<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DigitalOceanWebGoat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provision:web-goat {--provider=} {--api-key=}';

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
       $provider = $this->option('provider'); 
       $key = $this->option('api-key');

       echo "provider: {$provider} key: {$key} \n";
    }
}
