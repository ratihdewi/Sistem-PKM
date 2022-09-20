<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', fn (User $user) => $user->role_id === 1);
        Gate::define('dosen', fn (User $user) => $user->role_id === 2);
        Gate::define('mahasiswa', fn (User $user) => $user->role_id === 3);
    }
}
