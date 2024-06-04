<?php

use App\Http\Controllers\Frontend\AboutUsPageController;
use App\Http\Controllers\Frontend\FrontendJobPageController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CandidateExperienceController;
use App\Http\Controllers\Frontend\CandidateProfileController;
use App\Http\Controllers\Frontend\CandidateDashboardController;
use App\Http\Controllers\Frontend\CandidateEducationController;
use App\Http\Controllers\Frontend\CandidateJobBookmarkController;
use App\Http\Controllers\Frontend\CandidateMyJobController;
use App\Http\Controllers\Frontend\CheckoutPageController;
use App\Http\Controllers\Frontend\CompanyDashboardController;
use App\Http\Controllers\Frontend\CompanyProfileController;
use App\Http\Controllers\Frontend\ContactPageController;
use App\Http\Controllers\Frontend\FrontendBlogPageController;
use App\Http\Controllers\Frontend\FrontendCandidatePageController;
use App\Http\Controllers\Frontend\FrontendCompanyPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Frontend\LangController;
use App\Http\Controllers\Frontend\NewsletterController;
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

Route::get('job-bookmark/{id}', [CandidateJobBookmarkController::class, 'save'])->name('job.bookmark');


// Pricing page
Route::get('pricing', PricingPageController::class)
    ->name('pricing.index');

// Find a job page
Route::get('jobs', [FrontendJobPageController::class, 'index'])->name('jobs.index');
Route::get('jobs/{slug}', [FrontendJobPageController::class, 'show'])->name('job.show');
Route::post('apply/{id}', [FrontendJobPageController::class, 'applyJob'])->name('apply-job.store');

// Blog page
Route::get('blogs', [FrontendBlogPageController::class, 'index'])->name('blogs.index');
Route::get('blogs/{slug}', [FrontendBlogPageController::class, 'show'])->name('blogs.show');

// about page
Route::get('about-page',[AboutUsPageController::class, 'index'])->name('about-page.index');

// contact page
Route::get('contact',[ContactPageController::class, 'index'])->name('contact.index');
Route::post('contact',[ContactPageController::class, 'sendMail'])->name('send-mail');

// newsletter
Route::post('new-letter', [NewsletterController::class, 'store'])->name('new-letter.store');

Route::get('lang/{lang}', [LangController::class, 'changeLang'])->name('lang.change');

/* COMPANY */
Route::group(
    [
        'middleware' => ['auth', 'verified', 'user.role:company'],
        'as' => 'company.',
        'prefix' => 'company'
    ],
    function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');

        // order router
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('orders.invoice');

        // job router
        Route::resource('jobs', JobController::class);
        Route::get('applications/{id}', [JobController::class, 'applications'])->name('job.applications');

        Route::get('/profile', [CompanyProfileController::class, 'index'])->name('profile');
        Route::post('/profile/company-info', [CompanyProfileController::class, 'companyInfoUpdate'])->name('profile.company-info');
        Route::post('/profile/founding-info', [CompanyProfileController::class, 'foundingInfoUpdate'])->name('profile.founding-info');
        Route::post('/profile/account-info', [CompanyProfileController::class, 'accountInfoUpdate'])->name('profile.account-info');
        Route::post('/profile/password-update', [CompanyProfileController::class, 'updatePassword'])->name('profile.password-update');

        // Checkout page
        Route::get('checkout/{id}', CheckoutPageController::class)->name('checkout.index');

        // Payment Route
        Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
        Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');

        Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
        Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');

        Route::get('payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
        Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
        Route::get('payment/error', [PaymentController::class, 'error'])->name('payment.error');

        Route::get('razorpay/redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay-redirect');
        Route::post('razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');
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

    // my job
    Route::get('/applied-job', [CandidateMyJobController::class, 'index'])->name('applied-job.index');
    Route::get('/bookmarked-job', [CandidateJobBookmarkController::class, 'index'])->name('bookmarked-job.index');
    Route::delete('/bookmarked-job/{id}', [CandidateJobBookmarkController::class, 'destroy'])->name('bookmarked-job.destroy');
});
