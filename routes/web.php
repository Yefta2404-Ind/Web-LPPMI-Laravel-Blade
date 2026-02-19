<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\Admin\SpmiDocumentController as AdminSpmi;
use App\Models\Survey;


/*
|--------------------------------------------------------------------------
| PUBLIC AREA (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/mutu-internal',
    [\App\Http\Controllers\Public\InternalQualityController::class,'index']
)->name('public.mutu-internal');


Route::get('/mutu-eksternal',
    [\App\Http\Controllers\PublicExternalQualityController::class, 'index']
)->name('public.mutu-eksternal');

Route::view('/kontak', 'public.kontak')->name('kontak');
Route::get('/', [NewsController::class, 'publicHome'])->name('home');

Route::get('/visi-misi', function () {
    return view('public.visi-misi');
});
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

/*
|--------------------------------------------------------------------------
| STAFF AREA
|--------------------------------------------------------------------------
| URL SELALU DIAWALI /staff
| AMAN DARI TABRAKAN news/{news}
*/
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

 Route::resource('mutu-internal', 
            \App\Http\Controllers\Staff\InternalQualityController::class);
    /* ================= NEWS (STAFF) ================= */
        Route::get('/news', [NewsController::class, 'staffIndex'])
            ->name('news.index');


        Route::get('/news/create', [NewsController::class, 'create'])
            ->name('news.create');

        Route::post('/news', [NewsController::class, 'store'])
            ->name('news.store');

        Route::get('/news/{news}/edit', [NewsController::class, 'edit'])
            ->name('news.edit');

        Route::put('/news/{news}', [NewsController::class, 'update'])
            ->name('news.update');

        Route::delete('/news/{news}', [NewsController::class, 'destroy'])
            ->name('news.destroy');

    /* ================= Survey (STAFF) ================= */
        Route::post('/surveys', [SurveyController::class, 'store'])
            ->name('surveys.store');
        Route::get('/surveys/create', [SurveyController::class, 'create'])
            ->name('surveys.create');

    /* ================= MUTU EKSTERNAL (STAFF) ================= */

Route::get('/mutu-eksternal',
    [\App\Http\Controllers\Staff\ExternalQualityController::class, 'index']
)->name('mutu-eksternal.index');

Route::get('/mutu-eksternal/create',
    [\App\Http\Controllers\Staff\ExternalQualityController::class, 'create']
)->name('mutu-eksternal.create');

Route::post('/mutu-eksternal',
    [\App\Http\Controllers\Staff\ExternalQualityController::class, 'store']
)->name('mutu-eksternal.store');

Route::get('/mutu-eksternal/{id}/edit',
    [\App\Http\Controllers\Staff\ExternalQualityController::class, 'edit']
)->name('mutu-eksternal.edit');

Route::put('/mutu-eksternal/{id}',
    [\App\Http\Controllers\Staff\ExternalQualityController::class, 'update']
)->name('mutu-eksternal.update');

Route::delete('/mutu-eksternal/{id}',
    [\App\Http\Controllers\Staff\ExternalQualityController::class, 'destroy']
)->name('mutu-eksternal.destroy');


        Route::get('mutu-internal', 
            [\App\Http\Controllers\staff\InternalQualityController::class,'index']
        )->name('mutu-internal.index');

        Route::patch('mutu-internal/{id}/approve',
            [\App\Http\Controllers\staff\InternalQualityController::class,'approve']
        )->name('mutu-internal.approve');

        Route::patch('mutu-internal/{id}/reject',
            [\App\Http\Controllers\Admin\InternalQualityController::class,'reject']
        )->name('mutu-internal.reject');

        Route::delete('mutu-internal/{id}',
            [\App\Http\Controllers\staff\InternalQualityController::class,'destroy']
        )->name('mutu-internal.destroy');


    /* ================= HERO BANNER (STAFF) ================= */
        Route::post('/hero-banners', [HeroBannerController::class, 'store'])
        ->name('hero-banners.store');
        Route::get('/hero-banners/create', [HeroBannerController::class, 'create'])
            ->name('hero-banners.create');

        /* ================= STRUKTUR ORGANISASI (STAFF) ================= */
        Route::get('/organization-structure', [OrganizationStructureController::class, 'index'])
            ->name('organization-structure.index');

        Route::get('/organization-structure/create', [OrganizationStructureController::class, 'create'])
            ->name('organization-structure.create');

        Route::post('/organization-structure', [OrganizationStructureController::class, 'store'])
            ->name('organization-structure.store');

        Route::get('/organization-structure/{id}/edit',
        [OrganizationStructureController::class, 'edit']
        )->name('organization-structure.edit');

        Route::put('/organization-structure/{id}',
        [OrganizationStructureController::class, 'update']
        )->name('organization-structure.update');

        Route::delete('/organization-structure/{id}', [OrganizationStructureController::class, 'destroy'])
            ->name('organization-structure.destroy');
         
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

    $myNews    = \App\Models\News::where('user_id', auth()->id())->latest()->get();
    $myAgenda  = \App\Models\Agenda::where('user_id', auth()->id())->latest()->get();
    $myVideos  = \App\Models\Video::where('user_id', auth()->id())->latest()->get();
    $mySurveys = Survey::where('created_by', auth()->id())
        ->latest()
        ->get();

    return view('dashboard', compact(
        'myNews',
        'myAgenda',
        'myVideos',
        'mySurveys'
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
            Route::get('/admin/agenda', [AgendaController::class, 'adminIndex'])
    ->name('admin.agenda.index');

        /* ================= SPMI DOCUMENT (ADMIN) ================= */

Route::resource('spmi-categories', \App\Http\Controllers\Admin\SpmiCategoryController::class);

Route::get('/spmi-categories', [SpmiCategoryController::class, 'index'])
    ->name('spmi_categories.index');

Route::get('/spmi', [SpmiDocumentController::class, 'index'])
    ->name('admin.spmi.index');


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


/* ================= MUTU EKSTERNAL (ADMIN) ================= */

Route::get('/mutu-eksternal',
    [\App\Http\Controllers\Admin\ExternalQualityController::class, 'index']
)->name('mutu-eksternal.index');

Route::post('/mutu-eksternal/{id}/approve',
    [\App\Http\Controllers\Admin\ExternalQualityController::class, 'approve']
)->name('mutu-eksternal.approve');

Route::post('/mutu-eksternal/{id}/reject',
    [\App\Http\Controllers\Admin\ExternalQualityController::class, 'reject']
)->name('mutu-eksternal.reject');



        /* ================= STRUKTUR ORGANISASI (ADMIN) ================= */
        Route::get('/organization-structure/pending',
            [OrganizationStructureController::class, 'pendingView']
        )->name('organization-structure.pending');

        // TAMBAHKAN INI: Route untuk choose-active
        Route::get('/organization-structure/choose-active',
            [OrganizationStructureController::class, 'chooseActive']
        )->name('organization-structure.choose-active');

        // HAPUS YANG DUPLIKAT INI:
        // Route::get('/admin/organization-structure/choose-active', ...)
        // Route::post('/admin/organization-structure/approve/{id}', ...)

        Route::post('/organization-structure/{id}/approve',
            [OrganizationStructureController::class, 'approve']
        )->name('organization-structure.approve');

        Route::post('/organization-structure/{id}/reject',
            [OrganizationStructureController::class, 'reject']
        )->name('organization-structure.reject');

        Route::get('/organization-structure',
            [OrganizationStructureController::class, 'approved']
        )->name('organization-structure.index');

        /* ================= NEWS (ADMIN) ================= */
        Route::post('/news/{news}/approve', [NewsController::class, 'approve'])
            ->name('news.approve');
        Route::post('/news/{news}/reject', [NewsController::class, 'reject'])
            ->name('news.reject');

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
        Route::post('/surveys/{survey}/approve', [SurveyController::class, 'approve'])
            ->name('surveys.approve');
        Route::get('/surveys', [SurveyController::class, 'adminIndex'])
            ->name('surveys.index');

        /* ================= HERO BANNER (ADMIN) ================= */
        Route::get('/hero-banners', [HeroBannerController::class, 'approved'])
            ->name('hero-banners.index');

        Route::post('/hero-banners/{banner}/approve', [HeroBannerController::class, 'approve'])
            ->name('hero-banners.approve');

        Route::post('/hero-banners/{banner}/reject', [HeroBannerController::class, 'reject'])
            ->name('hero-banners.reject');

        Route::patch('/hero-banners/{banner}/toggle-active', [HeroBannerController::class, 'toggleActive'])
            ->name('hero-banners.toggle-active');

        Route::patch('/hero-banners/{banner}/order', [HeroBannerController::class, 'updateOrder'])
            ->name('hero-banners.order');
        
        // PENDING
        Route::get('/hero-banners/pending', [HeroBannerController::class, 'pending'])
            ->name('hero-banners.pending');

        // APPROVED (management)
        Route::delete('/videos/{video}/unfeature', [VideoController::class, 'unfeature'])
            ->name('videos.unfeature');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
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