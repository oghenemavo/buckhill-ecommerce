<?php

namespace App\Providers;

use App\Interfaces\IAdminRepository;
use App\Interfaces\IBrandRepository;
use App\Interfaces\ICategoryRepository;
use App\Interfaces\IOrderRepository;
use App\Interfaces\IOrderStatusRepository;
use App\Interfaces\IPaymentRepository;
use App\Interfaces\IProductRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\AdminRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderStatusRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IAdminRepository::class, AdminRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IBrandRepository::class, BrandRepository::class);
        $this->app->bind(IOrderStatusRepository::class, OrderStatusRepository::class);
        $this->app->bind(IPaymentRepository::class, PaymentRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
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
