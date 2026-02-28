<?php

use App\Http\Controllers\SertifikatController;
use App\Livewire\Auths;
use App\Livewire\Batches;
use App\Livewire\Home;
use App\Livewire\Pesertas;
use App\Livewire\Sertifikats;
use App\Livewire\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;



Route::get('/livewire/preview-file/{filename}', [
    \App\Http\Controllers\LivewireFilePreviewController::class,
    'handle'
])->middleware(['web', 'auth'])->name('livewire.preview-file');;


// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/sertifikat', Sertifikats::class)->name('sertifikat');
    Route::get('/batch', Batches::class)->name('batch');
    Route::get('/peserta', Pesertas::class)->name('peserta');

    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

// Super Admin only routes
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/users', Users::class)->name('users');
});

// Guest routes (accessible without auth)
Route::get('/', Auths::class)->name('login')->middleware('guest');
Route::get('/sertifikat/{no_sertifikat}/download', [SertifikatController::class, 'download'])->name('sertifikat.download');
