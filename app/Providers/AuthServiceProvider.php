<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('admin', fn ($user) => $user->role_id === 1);
        Gate::define('dosen', fn ($user) => $user->role_id === 2);
        Gate::define('mahasiswa', fn ($user) => $user->role_id === 3);

        Gate::define('is_reviewer', fn ($user) => $user->is_reviewer === 1);
    }
}
