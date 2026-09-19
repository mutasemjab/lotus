<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\ContactSectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MarqueeItemController;
use App\Http\Controllers\Admin\ProcessStepController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TrustItemController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Permission;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

        // ── Dashboard ─────────────────────────────────────────────────
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

        // ── Admin profile ─────────────────────────────────────────────
        Route::get('/admin/edit/{id}',    [LoginController::class, 'editlogin'])->name('admin.login.edit');
        Route::post('/admin/update/{id}', [LoginController::class, 'updatelogin'])->name('admin.login.update');

        // ── Roles & Employees ─────────────────────────────────────────
        Route::resource('employee', EmployeeController::class, ['as' => 'admin'])->except(['show']);
        Route::get('role',               [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('role/create',        [RoleController::class, 'create'])->name('admin.role.create');
        Route::get('role/{id}/edit',     [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::patch('role/{id}',        [RoleController::class, 'update'])->name('admin.role.update');
        Route::post('role',              [RoleController::class, 'store'])->name('admin.role.store');
        Route::post('admin/role/delete',  [RoleController::class, 'delete'])->name('admin.role.delete');
        Route::delete('role/{id}',        [RoleController::class, 'destroy'])->name('admin.role.destroy');

        Route::get('/permissions/{guard_name}', function ($guard_name) {
            return response()->json(Permission::where('guard_name', $guard_name)->get());
        });

        // ── Website Content Management ────────────────────────────────

        // Hero
        Route::get('website/hero',    [HeroSectionController::class, 'edit'])->name('admin.website.hero.edit');
        Route::put('website/hero',    [HeroSectionController::class, 'update'])->name('admin.website.hero.update');

        // Marquee
        Route::resource('website/marquee', MarqueeItemController::class, ['as' => 'admin.website'])
            ->parameters(['marquee' => 'marquee'])
            ->except(['show']);

        // About
        Route::get('website/about',                              [AboutSectionController::class, 'edit'])->name('admin.website.about.edit');
        Route::put('website/about',                              [AboutSectionController::class, 'update'])->name('admin.website.about.update');
        Route::post('website/about/stat',                        [AboutSectionController::class, 'storeStat'])->name('admin.website.about.stat.store');
        Route::put('website/about/stat/{stat}',                  [AboutSectionController::class, 'updateStat'])->name('admin.website.about.stat.update');
        Route::delete('website/about/stat/{stat}',               [AboutSectionController::class, 'destroyStat'])->name('admin.website.about.stat.destroy');

        // Services
        Route::get('website/services',                           [ServiceController::class, 'index'])->name('admin.website.services.index');
        Route::put('website/services/header',                    [ServiceController::class, 'updateHeader'])->name('admin.website.services.update-header');
        Route::get('website/services/create',                    [ServiceController::class, 'create'])->name('admin.website.services.create');
        Route::post('website/services',                          [ServiceController::class, 'store'])->name('admin.website.services.store');
        Route::get('website/services/{service}/edit',            [ServiceController::class, 'edit'])->name('admin.website.services.edit');
        Route::put('website/services/{service}',                 [ServiceController::class, 'update'])->name('admin.website.services.update');
        Route::delete('website/services/{service}',              [ServiceController::class, 'destroy'])->name('admin.website.services.destroy');

        // Process Steps
        Route::get('website/process',                            [ProcessStepController::class, 'index'])->name('admin.website.process.index');
        Route::put('website/process/header',                     [ProcessStepController::class, 'updateHeader'])->name('admin.website.process.update-header');
        Route::get('website/process/create',                     [ProcessStepController::class, 'create'])->name('admin.website.process.create');
        Route::post('website/process',                           [ProcessStepController::class, 'store'])->name('admin.website.process.store');
        Route::get('website/process/{step}/edit',                [ProcessStepController::class, 'edit'])->name('admin.website.process.edit');
        Route::put('website/process/{step}',                     [ProcessStepController::class, 'update'])->name('admin.website.process.update');
        Route::delete('website/process/{step}',                  [ProcessStepController::class, 'destroy'])->name('admin.website.process.destroy');

        // Trust Band
        Route::get('website/trust',                              [TrustItemController::class, 'index'])->name('admin.website.trust.index');
        Route::get('website/trust/create',                       [TrustItemController::class, 'create'])->name('admin.website.trust.create');
        Route::post('website/trust',                             [TrustItemController::class, 'store'])->name('admin.website.trust.store');
        Route::get('website/trust/{trust}/edit',                 [TrustItemController::class, 'edit'])->name('admin.website.trust.edit');
        Route::put('website/trust/{trust}',                      [TrustItemController::class, 'update'])->name('admin.website.trust.update');
        Route::delete('website/trust/{trust}',                   [TrustItemController::class, 'destroy'])->name('admin.website.trust.destroy');

        // Team
        Route::get('website/team',                               [TeamMemberController::class, 'index'])->name('admin.website.team.index');
        Route::put('website/team/header',                        [TeamMemberController::class, 'updateHeader'])->name('admin.website.team.update-header');
        Route::get('website/team/create',                        [TeamMemberController::class, 'create'])->name('admin.website.team.create');
        Route::post('website/team',                              [TeamMemberController::class, 'store'])->name('admin.website.team.store');
        Route::get('website/team/{member}/edit',                 [TeamMemberController::class, 'edit'])->name('admin.website.team.edit');
        Route::put('website/team/{member}',                      [TeamMemberController::class, 'update'])->name('admin.website.team.update');
        Route::delete('website/team/{member}',                   [TeamMemberController::class, 'destroy'])->name('admin.website.team.destroy');

        // Contact
        Route::get('website/contact',                            [ContactSectionController::class, 'index'])->name('admin.website.contact.index');
        Route::put('website/contact/header',                     [ContactSectionController::class, 'updateHeader'])->name('admin.website.contact.update-header');
        Route::put('website/contact/settings',                   [ContactSectionController::class, 'updateSettings'])->name('admin.website.contact.update-settings');
        Route::post('website/contact/phone',                     [ContactSectionController::class, 'storePhone'])->name('admin.website.contact.phone.store');
        Route::put('website/contact/phone/{phone}',              [ContactSectionController::class, 'updatePhone'])->name('admin.website.contact.phone.update');
        Route::delete('website/contact/phone/{phone}',           [ContactSectionController::class, 'destroyPhone'])->name('admin.website.contact.phone.destroy');
        Route::put('website/contact/location',                   [ContactSectionController::class, 'updateLocation'])->name('admin.website.contact.update-location');

    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login',  [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});
