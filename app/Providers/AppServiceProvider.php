<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
    View::composer('*', function ($view) {
        if (Auth::check()) {
            /** @var \App\Models\User $authUser */
            $authUser = Auth::user(); 

            $pendingCount = $authUser->followers()
                                     ->where('request_approved', false)
                                     ->count();
                                            
            $view->with('pendingFollowRequestsCount', $pendingCount);
        }
    });
}
}
