<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Repositories\OfficeRepository;
use App\Infrastructure\Repositories\TenderProjectRepository;
use App\Infrastructure\Repositories\UserRepository;
use App\Domain\Repositories\OfficeRepositoryInterface;
use App\Domain\Repositories\TenderProjectRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OfficeRepositoryInterface::class, OfficeRepository::class);
        $this->app->bind(TenderProjectRepositoryInterface::class, TenderProjectRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
