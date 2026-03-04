<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\InternalCategory;
use Illuminate\Support\Facades\View; 
use App\Models\Menu;
use App\Models\SiteSetting;
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

       View::composer('*', function ($view) {
    if (view()->exists('layouts.public')) {
        $menus = Menu::whereNull('parent_id')
                    ->where('is_active', true)
                    ->with('children')
                    ->orderBy('order')
                    ->get();

        $view->with('menus', $menus);

        view()->composer('*', function ($view) {
        $settings = SiteSetting::first();
        $view->with('settings', $settings);
    });
    }
});
}


}
