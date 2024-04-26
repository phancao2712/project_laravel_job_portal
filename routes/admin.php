<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndustryTypeController;
use App\Http\Controllers\Admin\OrganizationTypeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\JobExperienceController;
use App\Http\Controllers\Admin\JobRoleController;
use App\Http\Controllers\Admin\JobTypeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\SalaryTypeController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

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
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
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

    /* PROFESSION ROUTE */
    Route::resource('professions', ProfessionController::class);

    /* SKILL ROUTE */
    Route::resource('skills', SkillController::class);

    /* PLAN ROUTE */
    Route::resource('plans', PlanController::class);

    /* PAYMENT SETTING ROUTE */
    Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::post('paypal-update', [PaymentSettingController::class, 'updatePaypalSetting'])->name('paypal-settings.update');
    Route::post('stripe-update', [PaymentSettingController::class, 'updateStripeSetting'])->name('stripe-settings.update');
    Route::post('razorpay-update', [PaymentSettingController::class, 'updateRazorpaySetting'])->name('razorpay-settings.update');

    /* SITE SETTING ROUTE */
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('site-update', [SiteSettingController::class, 'updateGeneralSetting'])->name('site-settings.update');

    /* ORDERS SETTING ROUTE */
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('invoice/{id}', [OrderController::class, 'invoice'])->name('orders.invoice');

    /* JOB CATEGORY ROUTE */
    Route::resource('job-categories', JobCategoryController::class);

    /* EDUCATION ROUTE */
    Route::resource('education', EducationController::class);

    /*  JOB TYPE ROUTE */
    Route::resource('job-types', JobTypeController::class);

    /*  SALARY TYPE ROUTE */
    Route::resource('salary-types', SalaryTypeController::class);

    /*  TAG ROUTE */
    Route::resource('tags', TagController::class);

    /*  JOB ROLE ROUTE */
    Route::resource('job-roles', JobRoleController::class);

    /*  JOB EXPERIENCE ROUTE */
    Route::resource('job-experiences', JobExperienceController::class);

    /*  JOB ROUTE */
    Route::resource('jobs', JobController::class);
    Route::post('/updateStatus/{id}', [JobController::class, 'changeStatus'])->name('jobStatus.update');

    /*  JOB ROUTE */
    Route::resource('blogs', BlogController::class);
    Route::post('/updateStatusBlog/{id}', [BlogController::class, 'changeStatus'])->name('blogStatus.update');
});
