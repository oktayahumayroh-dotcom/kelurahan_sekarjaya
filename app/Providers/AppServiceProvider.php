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
// 🔔 NOTIF GLOBAL (sementara tanpa database)
View::composer('*', function ($view) {
    $notifs = collect();
    $unread = 0;

    $view->with(compact('notifs', 'unread'));
});
    }
}
