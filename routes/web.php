<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\OfficeController;
use App\Models\Ip;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

Route::get('/', function () {
    $office = null;
    $userIP = $_SERVER['REMOTE_ADDR'];
    //check if IP is registered
    $match = Ip::firstWhere('address', $userIP);
    if ($match) {
        $office = $match->office()->first()->name;
    }
    // dd($office);
    return Inertia::render('GuestStart', ['office' => $office]);

})->name('guest.start');

Route::resource('feedback', FeedbackController::class);

Route::prefix('admin')->group(function () {
    Route::put('offices/{office}/restore', [OfficeController::class, 'restore'])->name('offices.restore');
    Route::resource('offices', OfficeController::class);
    Route::resource('ips', IpController::class);

});
