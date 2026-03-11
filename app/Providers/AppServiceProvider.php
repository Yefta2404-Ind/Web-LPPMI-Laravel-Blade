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
    public function register(): void
    {
        //
    }

    public function boot()
    {
        // Semua view dapat $internalCategories
        View::composer('*', function ($view) {
            $view->with('internalCategories', InternalCategory::orderBy('name')->get());
        });

        // Semua view dapat $settings
        View::composer('*', function ($view) {
            $view->with('settings', SiteSetting::first());
        });

        // $menus untuk frontend (public) saja — TIDAK override halaman admin
View::composer('layouts.public', function ($view) {
    $menus = Menu::whereNull('parent_id')
        ->where('is_active', true)
        ->with([
            'children' => function ($q) {
                $q->where('is_active', true)->orderBy('order');
            },
            'children.page',
            'page'
        ])
        ->orderBy('order')
        ->get();

    $view->with('menus', $menus);
});
    }
}