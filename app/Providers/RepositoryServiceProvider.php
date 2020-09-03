<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\IClientRepository;
use App\Repositories\Eloquents\ClientRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Interfaces\IVendorRepository;
use App\Repositories\Eloquents\VendorRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Eloquents\OrderRepository;
use App\Repositories\Interfaces\IPaymentRepository;
use App\Repositories\Eloquents\PaymentRepository;
use App\Repositories\Interfaces\IInventoryRepository;
use App\Repositories\Eloquents\InventoryRepository;
use App\Repositories\Interfaces\ISaleProductRepository;
use App\Repositories\Eloquents\SaleProductRepository;
use App\Repositories\Interfaces\IPurchaseRepository;
use App\Repositories\Eloquents\PurchaseRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IClientRepository::class, ClientRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IVendorRepository::class, VendorRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IPaymentRepository::class, PaymentRepository::class);
        $this->app->bind(IInventoryRepository::class, InventoryRepository::class);
        $this->app->bind(ISaleProductRepository::class, SaleProductRepository::class);
        $this->app->bind(IPurchaseRepository::class, PurchaseRepository::class);

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
