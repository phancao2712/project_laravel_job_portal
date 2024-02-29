<?php
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndustryTypeController;
use App\Http\Controllers\Admin\OrganizationTypeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin'], 'prefix' => 'admin', 'as' => 'admin.'] ,function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

/* ADMIN ROUTE */
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'],function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
    /* ADMIN DASHBOARD ROUTE */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* END ADMIN DASHBOARD ROUTE */

    /* INDUSTRY TYPE ROUTE */
    Route::resource('industry-types', IndustryTypeController::class);

    /* ORGANIZATION TYPE ROUTE */
    Route::resource('organization-types', OrganizationTypeController::class);

    /* COUNTRIES ROUTE */
    Route::resource('country', CountryController::class);

    /* PROVINCES ROUTE */
    Route::resource('province', ProvinceController::class);

    /* DISTRICT ROUTE */
    Route::resource('district', DistrictController::class);

    /* LOCATION ROUTE */
    Route::get('get-province/{id}', [LocationController::class, 'getProvinceByCountry'])->name('location.get-province');

    /* LANGUAGES ROUTE */
    Route::resource('languages', LanguageController::class);
});
