<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});


// Registration
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('reg');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::get('/', [UserController::class, 'frontendjobs'])->name('frontend.jobs');
Route::post('/applyjob/{id}', [UserController::class, 'apply'])->name('apply.jobs');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/dashboard', [AdminController::class, 'getjobs']);
    Route::put('/dashboard/{id}', [AdminController::class, 'approvejobs'])->name('approve.job');
    Route::put('/dashboards/{id}', [AdminController::class, 'disapprovejobs'])->name('disapprove.job');
    Route::delete('/dashboard/{id}', [AdminController::class, 'deletejob'])->name('del.job');
    // Route::post('/todo', [AdminController::class, 'todo']);

    // Other admin routes

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'candidate'])->prefix('candidate')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/dashboard', [UserController::class, 'frontendjobs'])->name('frontend.jobs');

    // Other user routes

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'employer'])->prefix('employer')->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'index'])->name('employ');
    Route::post('/postjob', [EmployerController::class, 'post']);
    Route::get('/dashboard', [EmployerController::class, 'postjobs'])->name('postjobs');
    Route::get('/dashboard/{id}', [EmployerController::class, 'viewjobs'])->name('view.job');

    Route::put('/dashboard/{id}', [EmployerController::class, 'editjobs'])->name('edit.jobs');
    Route::delete('/dashboard/{id}', [EmployerController::class, 'deletejobs'])->name('delete.job');
    // Other user routes

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
