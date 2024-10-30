<?php

use App\Http\Controllers\Backend\CompanyProfileController;
use App\Http\Controllers\Backend\InternshipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;




    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('authenticate',[AuthController::class,'authenticate'])->name('authenticate');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class,'dashobard'])->name('dashboard');

    Route::resource('internships', InternshipController::class);

    Route::put('company-profiles/{company_profile}', [CompanyProfileController::class, 'update'])->name('company.profile.update');

    Route::get('company-profiles', [CompanyProfileController::class, 'index'])->name('company.profile.index');
    Route::get('company-profiles/create', [CompanyProfileController::class, 'create'])->name('company_profiles.create');
    Route::post('company-profiles', [CompanyProfileController::class, 'store'])->name('company_profiles.store');
    Route::get('company-profiles/{company_profile}', [CompanyProfileController::class, 'show'])->name('company_profiles.show');
    Route::get('company-profiles/{company_profile}/edit', [CompanyProfileController::class, 'edit'])->name('company_profiles.edit');
    Route::delete('company-profiles/{company_profile}', [CompanyProfileController::class, 'destroy'])->name('company_profiles.destroy');


















