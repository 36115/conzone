<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use TeamTeaTime\Forum\Http\Controllers\Blade\CategoryController;

Route::get('/', [CategoryController::class, 'index'])->name('index');

Route::get('/about', function () {
    return view('index');
});

Route::get('/rules', function () {
    return view('rules');
});

Route::get('/admin', function () {
    return redirect('/profile/' . Auth::user()->id);
})->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () { return redirect('/@' . Auth::user()->username); })->name('profile');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/@{username}', [ProfileController::class, 'showusername'])->name('profile.showusername');
    Route::get('/security', function () { return redirect('settings/security'); })->name('security');
    Route::get('/settings', function () { return redirect('settings/profile'); })->name('settings');
    Route::get('/settings/security', function () { return view('profile.security'); })->name('profile.security');
    Route::get('/edit/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/edit/profile/social', [ProfileController::class, 'socialUpdate'])->name('profile.socialupdate');
    Route::delete('/edit/profile/remove/profile', [ProfileController::class, 'pfprem'])->name('profile.remove');
    Route::delete('/edit/profile/remove/banner', [ProfileController::class, 'bnerem'])->name('banner.remove');
    Route::delete('/edit/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
