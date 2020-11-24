<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UtilController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::resource('survey', SurveyController::class)->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () { //TODO: middleware should be role:admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::put('offices/{office}/restore', [OfficeController::class, 'restore'])->name('offices.restore');
    Route::resource('offices', OfficeController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('feedback', FeedbackController::class);

    Route::get('feedback/{feedback}/comments/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::patch('feedback/{feedback}/comments/', [CommentController::class, 'store'])->name('comments.store');

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

});

Route::prefix('tools')->middleware('auth')->group(function () { //TODO: middleware should be role:admin
    Route::get('export', [UtilController::class, 'create'])->name('export.create');
    Route::post('checkPassCode', [UtilController::class, 'checkPassCode'])->name('export.check');
    Route::post('export', [UtilController::class, 'export'])->name('export');
    Route::post('import', [UtilController::class, 'import'])->name('import');
});
