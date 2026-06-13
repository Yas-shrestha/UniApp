<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ServiceController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog-detail', [FrontendController::class, 'blogDetail'])->name('blog-detail');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/courses', [FrontendController::class, 'courses'])->name('courses');
Route::get('/event-detail', [FrontendController::class, 'eventDetail'])->name('event-detail');
Route::get('/events', [FrontendController::class, 'events'])->name('events');
Route::get('/service-details', [FrontendController::class, 'serviceDetails'])->name('service-details');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/starter-page', [FrontendController::class, 'starterPage'])->name('starter-page');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('events', EventController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('services', ServiceController::class);
});

require __DIR__ . '/auth.php';
