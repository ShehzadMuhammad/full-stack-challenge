<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('companies', CompanyController::class)
    ->only(['index', 'store'])
    ->middleware(['auth']);

Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');

Route::resource('jobposts', JobPostController::class)
    ->only(['index', 'store'])
    ->middleware(['auth']);


Route::put('/jobposts/{jobpost}', [JobPostController::class, 'update'])->name('jobposts.update');
Route::delete('/jobposts/{jobpost}', [JobPostController::class, 'destroy'])->name('jobposts.destroy');
    
require __DIR__.'/auth.php';
