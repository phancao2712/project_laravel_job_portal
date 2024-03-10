<?php

use App\Http\Controllers\Frontend\CandidateExperienceController;
use App\Http\Controllers\Frontend\CandidateProfileController;
use App\Http\Controllers\Frontend\CandidateDashboardController;
use App\Http\Controllers\Frontend\CandidateEducationController;
use App\Http\Controllers\Frontend\CheckoutPageController;
use App\Http\Controllers\Frontend\CompanyDashboardController;
use App\Http\Controllers\Frontend\CompanyProfileController;
use App\Http\Controllers\Frontend\FrontendCandidatePageController;
use App\Http\Controllers\Frontend\FrontendCompanyPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\PricingPageController;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/* Location Router */
Route::get('get-province/{id}', [LocationController::class, 'getProvinceByCountry'])
    ->name('get-province');

Route::get('get-district/{id}', [LocationController::class, 'getDistrict'])
    ->name('get-district');


// Companies page
Route::get('companies', [FrontendCompanyPageController::class, 'index'])
    ->name('companies.index');

Route::get('companies/{slug}', [FrontendCompanyPageController::class, 'show'])
    ->name('companies.show');

// Candidates page
Route::get('candidates', [FrontendCandidatePageController::class, 'index'])
    ->name('candidates.index');

Route::get('candidates/{slug}', [FrontendCandidatePageController::class, 'show'])
    ->name('candidates.show');


// Pricing page
Route::get('pricing', PricingPageController::class)
    ->name('pricing.index');



/* COMPANY */
Route::group(
    [
        'middleware' => ['auth', 'verified', 'user.role:company'],
        'as' => 'company.',
        'prefix' => 'company'
    ],
    function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [CompanyProfileController::class, 'index'])->name('profile');
        Route::post('/profile/company-info', [CompanyProfileController::class, 'companyInfoUpdate'])->name('profile.company-info');

        Route::post('/profile/founding-info', [CompanyProfileController::class, 'foundingInfoUpdate'])->name('profile.founding-info');

        Route::post('/profile/account-info', [CompanyProfileController::class, 'accountInfoUpdate'])->name('profile.account-info');

        Route::post('/profile/password-update', [CompanyProfileController::class, 'updatePassword'])->name('profile.password-update');

        // Checkout page
        Route::get('checkout/{id}', CheckoutPageController::class)
            ->name('checkout.index');

        // Payment Route
        Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])
            ->name('paypal.payment');

        Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])
            ->name('paypal.success');

        Route::get('payment/cancel', [PaymentController::class, 'cancel'])
            ->name('payment.cancel');

        Route::get('payment/success', [PaymentController::class, 'success'])
            ->name('payment.success');

        Route::get('payment/error', [PaymentController::class, 'error'])
            ->name('payment.error');
    }
);

/* CANDIDATE */
Route::group([
    'middleware' => ['auth', 'verified', 'user.role:candidate'],
    'as' => 'candidate.',
    'prefix' => 'candidate'
], function () {
    Route::get('/dashboard', [CandidateDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [CandidateProfileController::class, 'index'])
        ->name('profile');

    Route::post('/basic-info', [CandidateProfileController::class, 'updateBasicInfo'])
        ->name('profile.basic-info');

    Route::post('/profile-info', [CandidateProfileController::class, 'updateProfileInfo'])
        ->name('profile.profile-info');

    Route::resource('experience', CandidateExperienceController::class);

    Route::resource('education', CandidateEducationController::class);

    Route::post('/account-info', [CandidateProfileController::class, 'updateAccountInfo'])
        ->name('profile.account-info');
});
