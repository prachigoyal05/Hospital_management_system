<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Staff\SampleController as StaffSampleController;
use App\Http\Controllers\Staff\TestController;
use App\Http\Controllers\Staff\ReportController;
use App\Http\Controllers\Admin\LabTestController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

// Redirect to correct dashboard based on role
Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            default => view('welcome'),
        };
    }
    return view('welcome');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Route::middleware(['auth', 'role:staff'])->group(function () {
//     Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
// });

// 🔐 Logout route (only one needed globally)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('patients', PatientController::class);
    Route::patch('patients/{id}/deactivate', [PatientController::class, 'deactivate'])->name('patients.deactivate');

    Route::resource('lab-tests', LabTestController::class);
    Route::resource('reports', AdminReportController::class);

    // Staff management (admin/staff/...)
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/', [AdminStaffController::class, 'index'])->name('index');
        Route::get('/create', [AdminStaffController::class, 'create'])->name('create');
        Route::post('/store', [AdminStaffController::class, 'store'])->name('store');
        Route::get('/export', [AdminStaffController::class, 'export'])->name('export');
        Route::get('/{id}', [AdminStaffController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminStaffController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminStaffController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminStaffController::class, 'destroy'])->name('destroy');
    });
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

Route::get('/reports/{report}/download', [AdminReportController::class, 'download'])
    ->name('admin.reports.download');

// In routes/web.php
Route::prefix('admin')->group(function() {
    // ... other routes
    
    Route::get('/patients/import', [PatientController::class, 'importView'])
        ->name('admin.patients.import-view');
        
    Route::post('/patients/import', [PatientController::class, 'import'])
        ->name('admin.patients.import');
});


// ==================== STAFF ROUTES ====================
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');

    Route::resource('samples', \App\Http\Controllers\Staff\SampleController::class);
    
    Route::resource('tests', TestController::class);
    Route::resource('reports', ReportController::class);
});
Route::get('/dashboard', function () {
    return view('dashboard');  // Create 'resources/views/dashboard.blade.php' if not exists
})->middleware(['auth'])->name('dashboard');
Route::get('/samples', [SampleController::class, 'index'])->name('samples.index');


require __DIR__.'/auth.php';
