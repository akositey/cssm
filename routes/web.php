<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('start');

Route::resource('feedback', FeedbackController::class)->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () { //TODO: middleware should be role:admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::put('offices/{office}/restore', [OfficeController::class, 'restore'])->name('offices.restore');
    Route::resource('offices', OfficeController::class);
    Route::resource('services', ServiceController::class);
});
