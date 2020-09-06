<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Petition;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('modify', function (User $user, Petition $petition) {
            //Modify - edit and delete - petition if it was created by you
            return $petition->user->is($user);
        });

        Gate::define('update', function (User $user, Petition $petition) {
            //Update petition if it was created by you
            return $petition->user->is($user);
        });

        Gate::define('sign', function (User $user, Petition $petition) {
            //Sign petition if it was not created by you
            return $user &&
                !$petition->user->is($user) &&
                !$petition->signatures()->where([
                    'petition_id' => $petition->id,
                    'email' => $user->email,
                ]);
        });

        Gate::define('view', function (User $user) {
            return $user->role === 'admin';
        });

        //
    }
}
