<?php

namespace App\Providers;

use App\Repositories\Tasks\TaskRepository;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Repositories\Teams\TeamRepository;
use App\Repositories\Teams\TeamRepositoryInterface;
use App\Repositories\Users\UserRepository;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\Tasks\TaskService;
use App\Services\Tasks\TaskServiceInterface;
use App\Services\Teams\TeamService;
use App\Services\Teams\TeamServiceInterface;
use App\Services\Users\UserService;
use App\Services\Users\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserServiceInterface::class => UserService::class,
        UserRepositoryInterface::class => UserRepository::class,

        TeamServiceInterface::class => TeamService::class,
        TeamRepositoryInterface::class => TeamRepository::class,

        TaskServiceInterface::class => TaskService::class,
        TaskRepositoryInterface::class => TaskRepository::class,
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
