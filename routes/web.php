<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/* COMPANY */
Route::group([
    'middleware' => ['auth', 'verified', 'user.role:company'],
    'as' => 'company.',
    'prefix' => 'company'
],
function(){
    Route::get('/dashboard', function () {
        return view('frontend.company-dashboard.dashboard');
    })->name('dashboard');
});

/* CANDIDATE */
Route::group([
    'middleware' => ['auth', 'verified', 'user.role:candidate'],
    'as' => 'candidate.',
    'prefix' => 'candidate'
], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
