<?php

namespace App\Providers;

use App\Events\CommentPosted;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

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
        // Event::listen(CommentPosted::class, function ($event) {
        //     Log::info('New comment posted: ' . $event->comment);
        // });
    }
}
