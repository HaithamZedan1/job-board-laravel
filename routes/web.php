<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
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

Route::get('/', fn()=>to_route('jobs.index'));

Route::resource('jobs',JobOfferController::class)->only(['index','show']);

Route::get('/login', fn()=>to_route('auth.create'));

Route::resource('auth',AuthController::class)->only(['create','store']);

Route::delete('/logout', fn()=>to_route('auth.destroy'));

Route::delete('auth',[AuthController::class,'destroy'])->name('auth.destroy');

Route::get('/signup', [AuthController::class, 'createNew'])->name('auth.create_new');

Route::post('/signup', [AuthController::class, 'storeNew'])->name('auth.store_new');




Route::middleware('auth')->group(function() {
    Route::resource('job.application',JobApplicationController::class)->only(['create','store']);
    Route::get('/download-cv', [JobApplicationController::class, 'downloadCv'])->name('download.cv');
    Route::resource('my-job-applications',MyJobApplicationController::class)->only(['index','destroy']);
    Route::resource('employer',EmployerController::class)->only(['create','store']);
    Route::middleware('employer')->resource('my-jobs',MyJobController::class);
});
