<?php

namespace App\Providers;

use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
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
        Event::listen(Registered::class, function ($event) {
        $user = $event->user;

        // Buat role 'customer' jika belum ada
        Role::findOrCreate('customer');

        // Assign role ke user baru
        $user->assignRole('customer');

        Carbon::setLocale('id');
    });
    }
}
