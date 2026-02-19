<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\InternalCategory;
use Illuminate\Support\Facades\View; 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
public function boot()
{
    // Membuat semua view punya $internalCategories
    View::composer('*', function ($view) {
        $view->with('internalCategories', InternalCategory::orderBy('name')->get());
    });
}


}
