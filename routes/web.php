<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ScoutingController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\SportswearController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes - EAGLE'S SC ACADEMY Management Platform
|--------------------------------------------------------------------------
*/

// Language Switcher (Ar <-> En with RTL/LTR)
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

// Authentication / Login Screen (Simulated Demo)
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

// Administrative Dashboard & Academy Intelligence
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/intelligence', [DashboardController::class, 'intelligence'])->name('intelligence.index');

// Player Management
Route::prefix('players')->name('players.')->group(function () {
    Route::get('/', [PlayerController::class, 'index'])->name('index');
    Route::get('/create', [PlayerController::class, 'create'])->name('create');
    Route::post('/', [PlayerController::class, 'store'])->name('store');
    Route::get('/goalkeepers', [PlayerController::class, 'goalkeepers'])->name('goalkeepers');
    Route::get('/files', [PlayerController::class, 'files'])->name('files');
    Route::get('/age-groups', [PlayerController::class, 'ageGroups'])->name('age-groups');
    Route::get('/teams', [PlayerController::class, 'teams'])->name('teams');
    Route::get('/transfers', [PlayerController::class, 'transfers'])->name('transfers');
    Route::get('/{id}/passport', [PlayerController::class, 'passport'])->name('passport');
    Route::get('/{id}', [PlayerController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PlayerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PlayerController::class, 'update'])->name('update');
});

// Coach Management
Route::prefix('coaches')->name('coaches.')->group(function () {
    Route::get('/', [CoachController::class, 'index'])->name('index');
    Route::get('/create', [CoachController::class, 'create'])->name('create');
    Route::post('/', [CoachController::class, 'store'])->name('store');
    Route::get('/{id}', [CoachController::class, 'show'])->name('show');
});

// Training, Tactics & Attendance
Route::prefix('training')->name('training.')->group(function () {
    Route::get('/', [TrainingController::class, 'index'])->name('index');
    Route::get('/tactics', [TrainingController::class, 'tactics'])->name('tactics');
});
Route::get('/tactics', [TrainingController::class, 'tactics'])->name('tactics.index');
Route::get('/attendance', [TrainingController::class, 'attendance'])->name('attendance.index');

// Registration & Talent Scouting
Route::get('/scouting', [ScoutingController::class, 'index'])->name('scouting.index');
Route::get('/scouting/{id}', [ScoutingController::class, 'index']);
Route::get('/registration', [ScoutingController::class, 'index'])->name('registration.index');

// Competitions & Fixtures
Route::get('/competitions', [CompetitionController::class, 'index'])->name('competitions.index');
Route::get('/competitions/{id}', [CompetitionController::class, 'index']);

// Subscriptions Management
Route::get('/subscriptions', [PaymentController::class, 'subscriptions'])->name('subscriptions.index');

// Payment Management System (HIGH PRIORITY)
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::get('/transactions', [PaymentController::class, 'transactions'])->name('transactions');
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/receipt/{id?}', [PaymentController::class, 'receipt'])->name('receipt');
    Route::get('/methods', [PaymentController::class, 'methods'])->name('methods');
    Route::get('/refunds', [PaymentController::class, 'refunds'])->name('refunds');
    Route::get('/{id}', [PaymentController::class, 'receipt']);
});

// Financial Management
Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');

// Sportswear & Inventory
Route::get('/sportswear', [SportswearController::class, 'index'])->name('sportswear.index');

// Sponsors & Strategic Partners
Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors.index');

// Academy Content Management (CMS) & Media
Route::get('/academy-content', [AcademyController::class, 'cms'])->name('academy.cms');
Route::get('/academy/cms', [AcademyController::class, 'cms']);
Route::get('/media', [AcademyController::class, 'media'])->name('media.index');

// Reports & Analytics
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

// Complaints & Suggestions
Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');

// User Management & Permissions
Route::get('/users', [UserController::class, 'index'])->name('users.index');
