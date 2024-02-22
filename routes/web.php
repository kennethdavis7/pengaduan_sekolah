<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuestAspirationController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/aspirations/create', [AspirationController::class, 'store'])->name('aspirations.store');
Route::get('guest-aspiration', [GuestAspirationController::class, 'index'])->name('guestaspirations.index');
Route::get('guest-aspiration/{aspiration}', [GuestAspirationController::class, 'show'])->name('guestaspiration.show');

Route::middleware('auth')->group(function () {

    Route::get('aspirations', [AspirationController::class, 'index'])->name('aspirations.index');
    Route::get('aspirations/{aspiration}/edit', [AspirationController::class, 'edit'])->name('aspirations.edit');
    Route::put('aspirations/{aspiration}', [AspirationController::class, 'update'])->name('aspirations.update');
    Route::get('aspirations/{aspiration}', [AspirationController::class, 'show'])->name('aspirations.show');
    Route::resource('categories', CategoryController::class)->names(
        [
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]
    );
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
