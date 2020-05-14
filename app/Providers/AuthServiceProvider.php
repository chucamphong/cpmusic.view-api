<?php

namespace App\Providers;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Song;
use App\Models\User;
use App\Policies\ArtistPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\SongPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Song::class => SongPolicy::class,
        Artist::class => ArtistPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::before(function (User $user, $ability) {
//            if ($user->hasRole('admin') && $ability !== 'delete') {
//                return true;
//            }
//        });
    }
}
