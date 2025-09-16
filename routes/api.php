<?php

use App\Http\Controllers\Api\Internal\V1\Admin\AuthController;
use App\Http\Controllers\Api\Internal\V1\Admin\ProfileController;
use App\Http\Controllers\Api\Internal\V1\Public\ProfileController as PublicProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/admin/auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('admin.auth.login');
});

Route::prefix('v1/public')->group(function () {
    Route::get('profiles', [PublicProfileController::class, 'list'])->name('public.profile.list');
});

// Routes protégées ADMIN
Route::middleware('auth:sanctum')->prefix('v1/admin')->group(function () {

    Route::post('profiles', [ProfileController::class, 'create'])->name('admin.profile.create');
    Route::put('profiles/{profile}', [ProfileController::class, 'update'])->name('admin.profile.update');

});
