<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('view_page_prep_residentiels', function ($user) {
        return $user->hasRole('Préposé aux clients résidentiels');
        });

        Gate::define('view_page_prep_affaire', function ($user) {
            return $user->hasRole('Préposé aux clients d’affaire');
        });

        
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('Administrateur')) {
                return true;
            }
        });
        //
    }
}
