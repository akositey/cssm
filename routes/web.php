<?php

use App\Http\Controllers\OfficeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('feedback', FeedbackController::class);

Route::prefix('admin')->group(function () {
    Route::put('offices/{office}/restore', [OfficeController::class, 'restore'])->name('offices.restore');
    Route::resource('offices', OfficeController::class);
    Route::resource('ips', IpController::class);

});
