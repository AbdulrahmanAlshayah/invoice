<?php

namespace App\Providers;

use App\Interfaces\Invoices\InvoicesRepositoryInterface;
use App\Interfaces\Users\UserRepositoryInterface;
use App\Models\Invoice;
use App\Repository\Invoices\InvoicesRepository;
use App\Repository\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(InvoicesRepositoryInterface::class, InvoicesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
