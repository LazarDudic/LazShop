<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return boolean
     */
    public function boot()
    {
        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        foreach (Permission::all() as $permission) {
            $permissionName = $permission->name;
            Gate::define($permissionName, function (User $user) use ($permissionName) {
                return $user->hasPermission($permissionName);
            });
        }
    }
}
