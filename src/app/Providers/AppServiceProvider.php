<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\iUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Product\iProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ShippingPrice\iShippingPriceRepository;
use App\Repositories\ShippingPrice\ShippingPriceRepository;
use App\Repositories\ShoppingCart\iShoppingCartRepository;
use App\Repositories\ShoppingCart\ShoppingCartRepository;
use App\Repositories\Order\iOrderRepository;
use App\Repositories\Order\OrderRepository;
use App\Services\User\iUserService;
use App\Services\User\UserService;
use App\Services\Product\iProductService;
use App\Services\Product\ProductService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->bind(iUserRepository::class, UserRepository::class);
        app()->bind(iUserService::class, UserService::class);
        app()->bind(iProductRepository::class, ProductRepository::class);
        app()->bind(iShippingPriceRepository::class, ShippingPriceRepository::class);
        app()->bind(iShoppingCartRepository::class, ShoppingCartRepository::class);
        app()->bind(iOrderRepository::class, OrderRepository::class);
        app()->bind(iProductService::class, ProductService::class);
    }
}
