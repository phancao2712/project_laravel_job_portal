<?php
use App\Http\Controllers\Frontend\CandidateDashboardController;
use App\Http\Controllers\Frontend\CompanyDashboardController;
use App\Http\Controllers\Frontend\CompanyProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
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

Route::get('/', [HomeController::class , 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/* Location Router */
Route::get('get-province/{id}', [LocationController::class , 'getProvinceByCountry'])
->name('get-province');

Route::get('get-district/{id}', [LocationController::class , 'getDistrict'])
->name('get-district');


/* COMPANY */
Route::group([
    'middleware' => ['auth', 'verified', 'user.role:company'],
    'as' => 'company.',
    'prefix' => 'company'
],
function(){
    Route::get('/dashboard',[CompanyDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile',[CompanyProfileController::class, 'index'])->name('profile');
    Route::post('/profile/company-info',[CompanyProfileController::class, 'companyInfoUpdate'])->
    name('profile.company-info');

    Route::post('/profile/founding-info',[CompanyProfileController::class, 'foundingInfoUpdate'])->
    name('profile.founding-info');

    Route::post('/profile/account-info',[CompanyProfileController::class, 'accountInfoUpdate'])->
    name('profile.account-info');

    Route::post('/profile/password-update',[CompanyProfileController::class, 'updatePassword'])->
    name('profile.password-update');
});

/* CANDIDATE */
Route::group([
    'middleware' => ['auth', 'verified', 'user.role:candidate'],
    'as' => 'candidate.',
    'prefix' => 'candidate'
], function () {
    Route::get('/dashboard',[CandidateDashboardController::class, 'index'])->name('dashboard');
});
