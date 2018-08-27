<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Lab;
use App\Application;

class DeployLab implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Lab
     */
    protected $lab;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Application $app
     * @param Lab $lab
     * @return void
     */
    public function __construct(User $user, Application $app, Lab $lab)
    {
        $this->lab = $lab;
        $this->user = $user;
        $this->app = $app;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $provider = $this->user->provider;
        $result = $provider->vps()->create($this->app, $this->lab);

        Lab::create([
            'name'           => $result->name,
            'external_id'    => $result->id,
            'provider_id'    => $provider->id,
            'user_id'        => $this->user->id,
            'access_ip'      => $this->lab->access_ip,
            'application_id' => $this->app->id
        ]);
    }
}
