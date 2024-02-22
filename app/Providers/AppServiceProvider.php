<?php

namespace App\Providers;

use App\Services\Auth\AuthInterface, App\Services\Auth\AuthService;
use App\Services\Cart\CartInterface, App\Services\Cart\CartService;
use App\Services\Items\ItemsInterface, App\Services\Items\ItemsService;
use App\Services\Orders\OrdersInterface, App\Services\Orders\OrdersService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthService::class);
        $this->app->bind(CartInterface::class, CartService::class);
        $this->app->bind(ItemsInterface::class, ItemsService::class);
        $this->app->bind(OrdersInterface::class, OrdersService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
