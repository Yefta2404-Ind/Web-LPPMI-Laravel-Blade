<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\InternalCategory;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\SiteSetting;
use App\Models\HeroBanner;
use App\Models\Agenda;
use App\Models\Survey;

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

    $heroBanners = HeroBanner::where('is_active',1)->get();

    $agendas = Agenda::where('status','approved')
    ->where('date', '>=', now()->subDays(3)->toDateString())
    ->orderBy('date', 'asc')
    ->take(5)
    ->get();

    $activeSurvey = Survey::where('status','approved')
        ->latest()
        ->first();

    $view->with(compact(
        'menus',
        'heroBanners',
        'agendas',
        'activeSurvey'
    ));
});
    }
}