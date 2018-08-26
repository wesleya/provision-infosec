<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Lab;
use Illuminate\Http\Request;

class DeployLab implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var array
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param array $data
     * @return void
     */
    public function __construct(User $user, $data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Lab $lab)
    {
        $lab->provision($this->user, $this->data);
    }
}
