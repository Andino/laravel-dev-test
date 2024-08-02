<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\JsonMapperServiceInterface;
use App\Services\JsonMapperService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(JsonMapperServiceInterface::class, JsonMapperService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
