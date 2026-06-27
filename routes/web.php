<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\EventGalleryController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\EventRegistrationControllerAdmin;
use App\Http\Controllers\ServiceReviewController;
use App\Http\Controllers\TestimonialController;

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
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post(
    '/services/{service}/reviews',
    [ServiceReviewController::class, 'store']
)->name('services.reviews.store');




Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('events', EventController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('files', FileController::class);
    // event-reservation
    Route::get('registrations', [EventRegistrationControllerAdmin::class, 'index'])->name('registrations.index');
    Route::get('registrations/create', [EventRegistrationControllerAdmin::class, 'create'])->name('registrations.create');
    Route::post('registrations', [EventRegistrationControllerAdmin::class, 'store'])->name('registrations.store');
    Route::get('registrations/{id}', [EventRegistrationControllerAdmin::class, 'show'])->name('registrations.show');
    Route::get('registrations/{id}/edit', [EventRegistrationControllerAdmin::class, 'edit'])->name('registrations.edit');
    Route::put('registrations/{id}', [EventRegistrationControllerAdmin::class, 'update'])->name('registrations.update');
    Route::delete('registrations/{id}', [EventRegistrationControllerAdmin::class, 'destroy'])->name('registrations.destroy');
    Route::get('registrations/export/{event?}', [EventRegistrationControllerAdmin::class, 'export'])->name('registrations.export');


    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/{id}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::post('contact/{id}/read', [ContactController::class, 'markAsRead'])->name('contact.read');
    Route::post('contact/{id}/replied', [ContactController::class, 'markAsReplied'])->name('contact.replied');

    Route::resource('event-galleries', EventGalleryController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::get('/service-reviews', [ServiceReviewController::class, 'index'])
        ->name('service-reviews.index');

    Route::get('/service-reviews/{serviceReview}', [ServiceReviewController::class, 'show'])
        ->name('service-reviews.show');

    Route::patch('/service-reviews/{serviceReview}/approve', [ServiceReviewController::class, 'approve'])
        ->name('service-reviews.approve');

    Route::patch('/service-reviews/{serviceReview}/reject', [ServiceReviewController::class, 'reject'])
        ->name('service-reviews.reject');

    Route::patch('/service-reviews/{serviceReview}/pending', [ServiceReviewController::class, 'pending'])
        ->name('service-reviews.pending');

    Route::delete('/service-reviews/{serviceReview}', [ServiceReviewController::class, 'destroy'])
        ->name('service-reviews.destroy');

        Route::resource('testimonials', TestimonialController::class);
});

require __DIR__ . '/auth.php';
