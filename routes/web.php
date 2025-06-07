<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Layanan\Index as Layanan;
use App\Livewire\Jadwal\Index as Jadwal;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/layanan', Layanan::class)->name('layanan.index');
    Route::get('/jadwal', Jadwal::class)->name('jadwal.index');

});
