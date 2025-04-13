<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Inertia\Inertia;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use Illuminate\Support\Facades\DB;



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts', PostController::class)->except(['show']);
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
   // routes/web.php
   Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');
   Route::get('/test-deletion', function() {
    // Get current and cutoff times using parameter binding
    $currentTime = now()->format('Y-m-d H:i:s');
    $cutoffTime = now()->subYears(2)->format('Y-m-d H:i:s');
    
    return [
        'current_time' => $currentTime,
        'cutoff_time' => $cutoffTime,
        'should_delete_count' => DB::table('posts')
                                ->where('created_at', '<', $cutoffTime)
                                ->count(),
        'sample_post' => DB::table('posts')
                         ->where('created_at', '<', $cutoffTime)
                         ->first(['id', 'title', 'created_at']),
        'actual_deleted' => DB::table('posts')
                           ->where('created_at', '<', $cutoffTime)
                           ->delete()
    ];
});
});

require __DIR__.'/auth.php';
