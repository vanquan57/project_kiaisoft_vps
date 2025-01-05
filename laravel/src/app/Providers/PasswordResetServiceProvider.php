<?php

namespace App\Providers;

use App\Http\Repositories\Eloquent\PasswordResetRepository;
use App\Http\Repositories\PasswordResetRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PasswordResetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            PasswordResetRepositoryInterface::class,
            PasswordResetRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
