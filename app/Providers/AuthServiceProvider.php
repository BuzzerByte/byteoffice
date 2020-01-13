<?php
<<<<<<< HEAD
namespace buzzeroffice\Providers;
=======
namespace App\Providers;
>>>>>>> 9364050604be82bb21bf77314501118a9268d954

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
<<<<<<< HEAD
        'buzzeroffice\Model' => 'buzzeroffice\Policies\ModelPolicy',
=======
        'App\Model' => 'App\Policies\ModelPolicy',
>>>>>>> 9364050604be82bb21bf77314501118a9268d954
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
