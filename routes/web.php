<?php

use App\Http\Controllers\Auth\RolesController;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Backend\AgentController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Agent Registration Routes
Route::get('register/agents', [AgentController::class, 'register'])->name('agents.registerForm');
Route::post('register/agents', [AgentController::class, 'store'])->name('agents.register');

Route::get('admission', [StudentController::class, 'form'])->name('student.form');
Route::post('admission', [StudentController::class, 'store'])->name('student.store');

Auth::routes(['verify' => true]);
Route::prefix('admin')->middleware(['verified', 'auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('profile', [UsersController::class, 'profile'])->name('profile');
    Route::put('profile/update/{id}', [UsersController::class, 'updateProfile'])->name('profile.update');

    // agent Certificate Download
    Route::get('agent/certificate', [AgentController::class, 'certificateDownload'])->name('agent.certificateDownload');

    // ***Admin Routes***
    Route::middleware(['role:Super Admin'])->group(function () {
        // Role Management Routes
        Route::resource('roles', RolesController::class);

        // User Management Routes
        Route::resource('users', UsersController::class);
        
        // Agent Routes
        Route::get('agents/pending/list', [AgentController::class, 'pendingAgent'])->name('agents.pending');
        Route::get('agents/approve/{id}', [AgentController::class, 'approveAgent'])->name('agents.approve');
        Route::resource('agents', AgentController::class);

        // Student Routes
        Route::get('students/approve/{id}', [StudentController::class, 'approveApplication'])->name('students.approve');
    });

    // Student Route
    Route::get('students/pending', [StudentController::class, 'pending'])->name('students.pending');
    Route::resource('students', StudentController::class);

});