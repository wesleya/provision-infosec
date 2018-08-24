<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Application;

class ProcessProvision implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var int
     */
    protected $type;

    protected $accessIP;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param int $type
     * @return void
     */
    public function __construct(User $user, $type, $accessIP)
    {
        $this->user = $user;
        $this->type = $type;
        $this->accessIP = $accessIP;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Application $application)
    {
        $application->provision($this->user, $this->type, $this->accessIP);
    }
}
