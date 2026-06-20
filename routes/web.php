<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\EventRegistrationController;

Route::get('/chatbot', [ChatbotController::class, 'index']);
Route::post('/chatbot/chat', [ChatbotController::class, 'chat']);
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/our-story', [FrontendController::class, 'ourStory'])->name('our-story');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blogs');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetail'])->name('blogs.show');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/courses', [FrontendController::class, 'courses'])->name('courses');
Route::get('/events', [FrontendController::class, 'events'])->name('events.index');
Route::get('/event-detail', [FrontendController::class, 'eventDetail'])->name('event-detail');
Route::get('/events/{event:slug}', [FrontendController::class, 'eventDetail'])->name('events.show');
Route::get('/service-details', [FrontendController::class, 'serviceDetails'])->name('service-details');
Route::get('/starter-page', [FrontendController::class, 'starterPage'])->name('starter-page');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/services/{slug}', [FrontendController::class, 'serviceDetails'])->name('services.detail');
Route::get('/admin/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');

Route::middleware('auth')->prefix('/admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('events', EventController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('files', FileController::class);
});

require __DIR__ . '/auth.php';
