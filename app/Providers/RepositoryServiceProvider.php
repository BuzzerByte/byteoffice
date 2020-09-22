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
use App\Repositories\Interfaces\IQuotationRepository;
use App\Repositories\Eloquents\QuotationRepository;
use App\Repositories\Interfaces\IQuotationProductRepository;
use App\Repositories\Eloquents\QuotationProductRepository;
use App\Repositories\Interfaces\IPurchaseProductRepository;
use App\Repositories\Eloquents\PurchaseProductRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Eloquents\CategoryRepository;
use App\Repositories\Interfaces\ITaxRepository;
use App\Repositories\Eloquents\TaxRepository;
use App\Repositories\Interfaces\IWithdrawalRepository;
use App\Repositories\Eloquents\WithdrawalRepository;
use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Eloquents\RoleRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Eloquents\EmployeeRepository;
use App\Repositories\Interfaces\IRoleEmployeeRepository;
use App\Repositories\Eloquents\RoleEmployeeRepository;
use App\Repositories\Interfaces\IEmployeeAttachmentRepository;
use App\Repositories\Eloquents\EmployeeAttachmentRepository;
use App\Repositories\Interfaces\IEmployeeSupervisorRepository;
use App\Repositories\Eloquents\EmployeeSupervisorRepository;
use App\Repositories\Interfaces\IEmployeeSubordinateRepository;
use App\Repositories\Eloquents\EmployeeSubordinateRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Repositories\Eloquents\DepartmentRepository;
use App\Repositories\Interfaces\IEmployeeDepositRepository;
use App\Repositories\Eloquents\EmployeeDepositRepository;
use App\Repositories\Interfaces\IEmployeeLoginRepository;
use App\Repositories\Eloquents\EmployeeLoginRepository;

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
        $this->app->bind(IQuotationRepository::class, QuotationRepository::class);
        $this->app->bind(IQuotationProductRepository::class, QuotationProductRepository::class);
        $this->app->bind(IPurchaseProductRepository::class, PurchaseProductRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ITaxRepository::class, TaxRepository::class);
        $this->app->bind(IWithdrawalRepository::class, WithdrawalRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
        $this->app->bind(IEmployeeRepository::class, EmployeeRepository::class);
        $this->app->bind(IRoleEmployeeRepository::class, RoleEmployeeRepository::class);
        $this->app->bind(IEmployeeAttachmentRepository::class, EmployeeAttachmentRepository::class);
        $this->app->bind(IEmployeeSupervisorRepository::class, EmployeeSupervisorRepository::class);
        $this->app->bind(IEmployeeSubordinateRepository::class, EmployeeSubordinateRepository::class);
        $this->app->bind(IDepartmentRepository::class, DepartmentRepository::class);
        $this->app->bind(IEmployeeDepositRepository::class, EmployeeDepositRepository::class);
        $this->app->bind(IEmployeeLoginRepository::class, EmployeeLoginRepository::class);
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
