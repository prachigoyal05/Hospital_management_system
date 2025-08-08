<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PatientController;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'staff') {
            return redirect()->route('staff.dashboard');
        }
    }
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('patients', \App\Http\Controllers\Admin\PatientController::class);
    Route::resource('lab-tests', \App\Http\Controllers\Admin\LabTestController::class);
    Route::resource('reports', \App\Http\Controllers\Admin\ReportController::class);
});     

Route::prefix('admin/staff')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminStaffController::class, 'index'])->name('admin.staff.index');
    Route::get('/create', [AdminStaffController::class, 'create'])->name('admin.staff.create');
    Route::post('/store', [AdminStaffController::class, 'store'])->name('admin.staff.store');
     Route::get('/export', [AdminStaffController::class, 'export'])->name('admin.staff.export');
    Route::get('/{id}', [AdminStaffController::class, 'show'])->name('admin.staff.show');
    Route::get('/{id}/edit', [AdminStaffController::class, 'edit'])->name('admin.staff.edit');
    Route::put('/{id}', [AdminStaffController::class, 'update'])->name('admin.staff.update');
    Route::delete('/{id}', [AdminStaffController::class, 'destroy'])->name('admin.staff.destroy');
    
         
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');
});

Route::patch('/patients/{patient}/toggle-status', [PatientController::class, 'toggleStatus'])
    ->name('admin.patients.toggle-status');

Route::post('/patients/import', [PatientController::class, 'import'])
    ->name('admin.patients.import');

    Route::get('/test-import', function() {
    $path = storage_path('app/sample_patients_import.csv');
    Excel::import(new \App\Imports\PatientsImport, $path);
    
    return [
        'imported' => \App\Models\Patient::count(),
        'latest' => \App\Models\Patient::latest()->first()
    ];
});

// In routes/web.php
Route::prefix('admin')->group(function() {
    // ... other routes
    
    Route::get('/patients/import', [PatientController::class, 'importView'])
        ->name('admin.patients.import-view');
        
    Route::post('/patients/import', [PatientController::class, 'import'])
        ->name('admin.patients.import');
});
require __DIR__.'/auth.php';
