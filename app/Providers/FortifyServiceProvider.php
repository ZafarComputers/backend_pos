<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // register bindings if needed
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Add this new line
        Fortify::ignoreRoutes();

        // define the views (fallback pages if you don't use modals)
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        // optionally customize authentication (e.g. check status)
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password) &&
                $user->status === 'active') {
                return $user;
            }

            return null;
        });
    }
}






