<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProfileController;
use App\Models\News;
use Carbon\Carbon;
use App\Http\Controllers\Admin\PopupBannerController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\HeroBannerController;
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Staff\SpmiDocumentController;
use App\Http\Controllers\PublicSpmiController;
use App\Http\Controllers\Admin\SpmiCategoryController;
use App\Http\Controllers\PublicExternalQualityController;
use App\Http\Controllers\Admin\InternalQualityController;
use App\Http\Controllers\Admin\InternalCategoryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SpmiDocumentController as AdminSpmi;
use App\Models\Survey;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Models\Page;

Route::post('/upload-image', [NewsController::class, 'uploadImage'])
    ->name('upload.image');
    

Route::get('/uraian-tugas', function () {
    return view('public.uraian-tugas');
});
Route::get('/sistem-penjamin', function () {
    return view('public.sistem-penjamin');
});

Route::get('/dokumen-penjamin',
    [PublicSpmiController::class, 'index']
)->name('public.spmi.index');



/* ================= NEWS (PUBLIC) ================= */
Route::get('/news', [NewsController::class, 'publicIndex'])
    ->name('public.news.index');

Route::get('/news/{news}', [NewsController::class, 'showPublic'])
    ->name('public.news.show');

/* ================= AGENDA (PUBLIC) ================= */
Route::get('/agenda', [AgendaController::class, 'publicAgenda'])->name('agenda.public');
Route::get('/agenda/{agenda}', [AgendaController::class, 'show'])->name('agenda.show');

/* ================= VIDEO (PUBLIC) ================= */
Route::get('/videos', [VideoController::class, 'publicIndex'])->name('videos.public');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/survey', [SurveyController::class, 'publicSurvey'])
    ->name('public.survey');
Route::get('/struktur-organisasi',
    [OrganizationStructureController::class, 'public']
)->name('public.organization-structure');


Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {


    /* ================= SPMI DOCUMENT (STAFF) ================= */
Route::get('/spmi/create',
    [SpmiDocumentController::class, 'create']
)->name('spmi.create');

Route::post('/spmi',
    [SpmiDocumentController::class, 'store']
)->name('spmi.store');


    /* ================= NEWS (STAFF) ================= */
        Route::get('/news', [NewsController::class, 'staffIndex'])
            ->name('news.index');

Route::delete('/news/{news}', [NewsController::class, 'destroy'])
    ->name('news.destroy');
        Route::get('/news/create', [NewsController::class, 'create'])
            ->name('news.create');

        Route::post('/news', [NewsController::class, 'store'])
            ->name('news.store');

        Route::get('/news/{news}/edit', [NewsController::class, 'edit'])
            ->name('news.edit');

        Route::put('/news/{news}', [NewsController::class, 'update'])
            ->name('news.update');


    /* ================= MUTU EKSTERNAL (STAFF) ================= */
        Route::resource('mutu-eksternal',
            \App\Http\Controllers\Staff\ExternalQualityController::class
        );

        // MUTU INTERNAL (CRUD)
        Route::resource('mutu-internal',
            \App\Http\Controllers\Staff\InternalQualityController::class
        );

       
        /* ================= AGENDA (STAFF) ================= */
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
        Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
        Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
        Route::get('/agenda/{agenda}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
        Route::put('/agenda/{agenda}', [AgendaController::class, 'update'])->name('agenda.update');
        Route::delete('/agenda/{agenda}', [AgendaController::class, 'destroy'])->name('agenda.destroy');

        /* ================= VIDEO (STAFF) ================= */
        Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
        Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
        Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
        Route::put('/videos/{video}', [VideoController::class, 'update'])->name('videos.update');
        Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');

        /* ================= USER MANAGEMET (STAFF) ================= */
        Route::get('/password', [\App\Http\Controllers\StaffPasswordController::class, 'edit'])
         ->name('password.edit');

        Route::post('/password', [\App\Http\Controllers\StaffPasswordController::class, 'update'])
        ->name('password.update');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (SEMUA USER LOGIN)
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->get('/dashboard', function () {

    $role = auth()->user()->role;

    if (in_array($role, ['admin', 'superadmin'])) {
        return redirect()->route('admin.dashboard');
    }

    $userId = auth()->id();

    $myNews   = \App\Models\News::where('user_id', $userId)->latest()->get();
    $myAgenda = \App\Models\Agenda::where('user_id', $userId)->latest()->get();

    $dates = collect();
    for ($i = 29; $i >= 0; $i--) {
        $dates->push(Carbon::now()->subDays($i)->format('Y-m-d'));
    }

    $pendingRaw = \App\Models\News::where('user_id', $userId)
        ->where('status', 'pending')
        ->whereDate('created_at', '>=', now()->subDays(30))
        ->get()
        ->groupBy(fn($item) => $item->created_at->format('Y-m-d'));

    $approvedRaw = \App\Models\News::where('user_id', $userId)
        ->where('status', 'approved')
        ->whereDate('created_at', '>=', now()->subDays(30))
        ->get()
        ->groupBy(fn($item) => $item->created_at->format('Y-m-d'));

    $pendingData = $dates->map(fn($date) => count($pendingRaw[$date] ?? []));
    $approvedData = $dates->map(fn($date) => count($approvedRaw[$date] ?? []));

    return view('dashboard', compact(
        'myNews',
        'myAgenda',
        'pendingData',
        'approvedData'
    ));

})->name('dashboard'); 

/*
|--------------------------------------------------------------------------
| ADMIN & SUPERADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,superadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('staff', StaffController::class);

        Route::get('/dashboard', [NewsController::class, 'adminDashboard'])
            ->name('dashboard');
            

        // ✅ BENAR — nama jadi admin.settings.edit & admin.settings.update
        Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SiteSettingController::class, 'update'])->name('settings.update');

        /* ================= SPMI DOCUMENT (ADMIN) ================= */

Route::resource('spmi-categories', \App\Http\Controllers\Admin\SpmiCategoryController::class);

Route::get('/spmi-categories', [SpmiCategoryController::class, 'index'])
    ->name('spmi_categories.index');

/* ================= PAGES (ADMIN) ================= */
Route::post('/pages/upload-image', [PageController::class, 'uploadImage'])
    ->name('pages.upload-image');
Route::patch('/pages/{page}/toggle-status', [PageController::class, 'toggleStatus'])
    ->name('pages.toggle-status');
Route::resource('pages', PageController::class);


    Route::resource('internal_categories', InternalCategoryController::class);
    Route::resource('internal_qualities', InternalQualityController::class);
Route::get('/spmi',
    [AdminSpmi::class, 'index']
)->name('spmi.index');

Route::post('/spmi/{id}/approve',
    [AdminSpmi::class, 'approve']
)->name('spmi.approve');

Route::post('/spmi/{id}/reject',
    [AdminSpmi::class, 'reject']
)->name('spmi.reject');

/* ================= SURVEY (ADMIN) ================= */
Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
Route::get('/surveys/create', [SurveyController::class, 'create'])->name('surveys.create');
Route::post('/surveys', [SurveyController::class, 'store'])->name('surveys.store');
Route::post('/surveys/{survey}/approve', [SurveyController::class, 'approve'])->name('surveys.approve');
Route::post('/surveys/{survey}/activate', [SurveyController::class, 'activate'])->name('surveys.activate'); // ← tambahkan ini
Route::delete('/surveys/{survey}', [SurveyController::class, 'destroy'])->name('surveys.destroy');


Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

/* ================= MUTU EKSTERNAL (ADMIN) ================= */

        Route::get('/mutu-eksternal',
            [\App\Http\Controllers\Admin\ExternalQualityController::class,'index']
        )->name('mutu-eksternal.index');

        Route::patch('/mutu-eksternal/{id}/approve',
            [\App\Http\Controllers\Admin\ExternalQualityController::class,'approve']
        )->name('mutu-eksternal.approve');

        Route::patch('/mutu-eksternal/{id}/reject',
            [\App\Http\Controllers\Admin\ExternalQualityController::class,'reject']
        )->name('mutu-eksternal.reject');

        Route::get('/mutu-internal',
            [\App\Http\Controllers\Admin\InternalQualityController::class,'index']
        )->name('mutu-internal.index');

        Route::patch('/mutu-internal/{id}/approve',
            [\App\Http\Controllers\Admin\InternalQualityController::class,'approve']
        )->name('mutu-internal.approve');

        Route::patch('/mutu-internal/{id}/reject',
            [\App\Http\Controllers\Admin\InternalQualityController::class,'reject']
        )->name('mutu-internal.reject');

/* ================= STRUKTUR ORGANISASI (ADMIN) ================= */
Route::get('/organization-structure',                      [OrganizationStructureController::class, 'index'])->name('organization-structure.index');
Route::get('/organization-structure/create',               [OrganizationStructureController::class, 'create'])->name('organization-structure.create');
Route::post('/organization-structure',                     [OrganizationStructureController::class, 'store'])->name('organization-structure.store');
Route::get('/organization-structure/{id}/edit',            [OrganizationStructureController::class, 'edit'])->name('organization-structure.edit');
Route::put('/organization-structure/{id}',                 [OrganizationStructureController::class, 'update'])->name('organization-structure.update');
Route::patch('/organization-structure/{id}/toggle-active',
    [OrganizationStructureController::class, 'toggleActive']
)->name('organization-structure.toggle-active');
Route::delete('/organization-structure/{id}',              [OrganizationStructureController::class, 'destroy'])->name('organization-structure.destroy');

        /* ================= NEWS (ADMIN) ================= */
Route::get('/news', [NewsController::class, 'adminIndex'])
    ->name('news.index');

// ACTIONS
Route::post('/news/{news}/approve', [NewsController::class, 'approve'])
    ->name('news.approve');

Route::post('/news/{news}/reject', [NewsController::class, 'reject'])
    ->name('news.reject');

// DELETE
Route::delete('/news/{news}', [NewsController::class, 'destroy'])
    ->name('news.destroy');

        /* ================= AGENDA (ADMIN) ================= */
        Route::get('/agenda', [AgendaController::class, 'adminIndex'])
            ->name('agenda.index');
        Route::post('/agenda/{agenda}/approve', [AgendaController::class, 'approve'])
            ->name('agenda.approve');
        Route::post('/agenda/{agenda}/reject', [AgendaController::class, 'reject'])
            ->name('agenda.reject');

        /* ================= VIDEO (ADMIN) ================= */
        Route::get('/videos', [VideoController::class, 'adminIndex'])
            ->name('videos.index');
        Route::get('/videos/pending', [VideoController::class, 'pending'])
            ->name('videos.pending');
        Route::post('/videos/{video}/approve', [VideoController::class, 'approve'])
            ->name('videos.approve');
        Route::post('/videos/{video}/reject', [VideoController::class, 'reject'])
            ->name('videos.reject');
        Route::patch('/videos/{video}/toggle-publish', [VideoController::class, 'togglePublish'])
            ->name('videos.toggle-publish');
        Route::post('/videos/{video}/featured', [VideoController::class, 'setFeatured'])
            ->name('videos.featured');

       /* ================= HERO BANNER (ADMIN) ================= */
Route::get('/hero-banners',                        [HeroBannerController::class, 'index'])->name('hero-banners.index');
Route::get('/hero-banners/create',                 [HeroBannerController::class, 'create'])->name('hero-banners.create');
Route::post('/hero-banners',                       [HeroBannerController::class, 'store'])->name('hero-banners.store');
Route::patch('/hero-banners/{banner}/toggle-active',[HeroBannerController::class, 'toggleActive'])->name('hero-banners.toggle-active');
Route::patch('/hero-banners/{banner}/order',       [HeroBannerController::class, 'updateOrder'])->name('hero-banners.order');
Route::delete('/hero-banners/{banner}',            [HeroBannerController::class, 'destroy'])->name('hero-banners.destroy');

        // APPROVED (management)
        Route::delete('/videos/{video}/unfeature', [VideoController::class, 'unfeature'])
            ->name('videos.unfeature');


Route::get('/popup', [PopupBannerController::class, 'index'])->name('popup.index');
Route::post('/popup', [PopupBannerController::class, 'store'])->name('popup.store');
Route::post('/popup/toggle', [PopupBannerController::class, 'toggleActive'])->name('popup.toggle');
Route::resource('popup', PopupBannerController::class);
       //SETTINGAN MENU 
       Route::post('/menus/reorder', [\App\Http\Controllers\Admin\MenuController::class, 'reorder'])
            ->name('menus.reorder');
        Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
        Route::post('menus/{menu}/toggle', [MenuController::class, 'toggle'])->name('admin.menus.toggle');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

Route::get('/', [NewsController::class, 'publicHome']);

Route::get('/{slug}', function ($slug) {

    $page = Page::where('slug', $slug)
        ->where('status', 'published')
        ->first();

    if (!$page) {
        abort(404);
    }

    $latestNews = News::where('status','approved')
        ->latest()
        ->limit(5)
        ->get();

    return view('public.page', compact('page','latestNews'));
});