<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoCms\App\Http\Controllers\TomatoCmsController;

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

if (config("tomato-cms.features.pages")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/pages', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'index'])->name('pages.index');
        Route::get('admin/pages/api', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'api'])->name('pages.api');
        Route::get('admin/pages/create', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'create'])->name('pages.create');
        Route::post('admin/pages', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'store'])->name('pages.store');
        Route::get('admin/pages/{model}', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');
        Route::get('admin/pages/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'edit'])->name('pages.edit');
        Route::post('admin/pages/{model}', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'update'])->name('pages.update');
        Route::delete('admin/pages/{model}', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'destroy'])->name('pages.destroy');
    });
}

if (config("tomato-cms.features.services")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/services', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
        Route::get('admin/services/api', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'api'])->name('services.api');
        Route::get('admin/services/create', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
        Route::post('admin/services', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
        Route::get('admin/services/{model}', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'show'])->name('services.show');
        Route::get('admin/services/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');
        Route::post('admin/services/{model}', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
        Route::delete('admin/services/{model}', [\Modules\TomatoCms\App\Http\Controllers\ServiceController::class, 'destroy'])->name('services.destroy');
    });
}

if (config("tomato-cms.features.portfolios")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/portfolios', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'index'])->name('portfolios.index');
        Route::post('admin/portfolios/scan', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'scan'])->name('portfolios.scan');
        Route::get('admin/portfolios/api', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'api'])->name('portfolios.api');
        Route::get('admin/portfolios/create', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'create'])->name('portfolios.create');
        Route::post('admin/portfolios', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'store'])->name('portfolios.store');
        Route::get('admin/portfolios/{model}', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'show'])->name('portfolios.show');
        Route::get('admin/portfolios/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'edit'])->name('portfolios.edit');
        Route::post('admin/portfolios/{model}', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'update'])->name('portfolios.update');
        Route::delete('admin/portfolios/{model}', [\Modules\TomatoCms\App\Http\Controllers\PortfolioController::class, 'destroy'])->name('portfolios.destroy');
    });
}

if (config("tomato-cms.features.testimonials")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/testimonials', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('admin/testimonials/api', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'api'])->name('testimonials.api');
        Route::get('admin/testimonials/create', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('admin/testimonials', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('admin/testimonials/{model}', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'show'])->name('testimonials.show');
        Route::get('admin/testimonials/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::post('admin/testimonials/{model}', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('admin/testimonials/{model}', [\Modules\TomatoCms\App\Http\Controllers\TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    });
}

if (config("tomato-cms.features.posts")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/posts', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
        Route::get('admin/posts/api', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'api'])->name('posts.api');
        Route::get('admin/posts/create', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
        Route::post('admin/posts', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
        Route::get('admin/posts/{model}', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
        Route::get('admin/posts/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
        Route::post('admin/posts/{model}', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
        Route::delete('admin/posts/{model}', [\Modules\TomatoCms\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
    });
}

if (config("tomato-cms.features.comments")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/comments', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
        Route::get('admin/comments/api', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'api'])->name('comments.api');
        Route::get('admin/comments/create', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'create'])->name('comments.create');
        Route::post('admin/comments', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
        Route::get('admin/comments/{model}', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'show'])->name('comments.show');
        Route::get('admin/comments/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
        Route::post('admin/comments/{model}', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
        Route::delete('admin/comments/{model}', [\Modules\TomatoCms\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    });
}

if (config("tomato-cms.features.photos")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/photos', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'index'])->name('photos.index');
        Route::get('admin/photos/api', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'api'])->name('photos.api');
        Route::get('admin/photos/create', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'create'])->name('photos.create');
        Route::post('admin/photos', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'store'])->name('photos.store');
        Route::get('admin/photos/{model}', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'show'])->name('photos.show');
        Route::get('admin/photos/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'edit'])->name('photos.edit');
        Route::post('admin/photos/{model}', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'update'])->name('photos.update');
        Route::delete('admin/photos/{model}', [\Modules\TomatoCms\App\Http\Controllers\PhotoController::class, 'destroy'])->name('photos.destroy');
    });
}

if (config("tomato-cms.features.skills")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/skills', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'index'])->name('skills.index');
        Route::get('admin/skills/api', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'api'])->name('skills.api');
        Route::get('admin/skills/create', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'create'])->name('skills.create');
        Route::post('admin/skills', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'store'])->name('skills.store');
        Route::get('admin/skills/{model}', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'show'])->name('skills.show');
        Route::get('admin/skills/{model}/edit', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'edit'])->name('skills.edit');
        Route::post('admin/skills/{model}', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'update'])->name('skills.update');
        Route::delete('admin/skills/{model}', [\Modules\TomatoCms\App\Http\Controllers\SkillController::class, 'destroy'])->name('skills.destroy');
    });
}
