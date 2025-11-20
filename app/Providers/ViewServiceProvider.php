<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.header', function ($view) {
            $categories = Category::select('id', 'name', 'slug')->get();
            $view->with('categories', $categories);
        });

        View::composer('*', function ($view) {
            $wishlistProductIds = auth()->check()
                ? auth()->user()->wishlists()->pluck('product_id')->toArray()
                : [];

            $view->with('wishlistProductIds', $wishlistProductIds);
        });
    }

}
