<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/blogs'; // Redirect to All Posts page

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        // ...existing code...
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        // ...existing code...
    }
}
