<?php

namespace App\Providers;

use App\Events\TaskAssigned;
use App\Events\TaskCompleted;
use App\Listeners\NotifyTeamLeaderTaskCompleted;
use App\Listeners\SendTaskAssignedEmail;
use App\Listeners\SendTaskCompletedEmail;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TaskAssigned::class => [
            SendTaskAssignedEmail::class,
        ],
        TaskCompleted::class => [
            SendTaskCompletedEmail::class,
            NotifyTeamLeaderTaskCompleted::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
