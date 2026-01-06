<?php

namespace App\Providers;

use App\Repositories\Joke\Contracts\JokeInterface;
use App\Repositories\Joke\JokeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(JokeInterface::class, JokeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
