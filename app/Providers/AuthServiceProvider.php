<?php

namespace App\Providers;

//use Illuminate\Auth\Access\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public static $permission = [
        'dashboard' => ['admin',]
    ];

    /**
     * The model to policy mappings for the application.
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

        Gate::before(function (User $user) {
            if ($user->role =='superadmin') {
                return true;
            }
        });


        foreach (self::$permission as $action => $role) {
            Gate::define($action, function(User $user) use ($role) {
                if (in_array($user->role, $role)){
                    return true;
                }
            });
        }

    }
}
