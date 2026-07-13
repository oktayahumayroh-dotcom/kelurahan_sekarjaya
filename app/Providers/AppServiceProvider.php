<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('id'); // ✅ tetap

        // 🔔 NOTIF GLOBAL
        View::composer('*', function ($view) {
            $notifs = Notifikasi::latest()->take(10)->get();
            $unread = Notifikasi::where('is_read', 0)->count();

            $view->with(compact('notifs', 'unread'));
        });
    }
}