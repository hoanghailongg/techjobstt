<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Following;
use App\Models\Job;
use App\Models\User;
use App\Observers\CompanyObserver;
use App\Observers\FollowingObserver;
use App\Observers\JobObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Following::observe(FollowingObserver::class);
        Job::observe(JobObserver::class);
        Company::observe(CompanyObserver::class);
    }
}
