<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('project.index');
});

Route::group(['middleware' => ['can:manage projects']], function () {
    
});

Route::group(['middleware' => ['role_or_permission:super-admin|admin|manage projects'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');

    Route::get('/{id}/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::get('/{projectId}/task/{taskId}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/{projectId}/task/edit/{taskId}', [TaskController::class, 'edit'])->name('task.edit');
});

Route::group(['middleware' => ['role_or_permission:manager|manage tasks'], 'prefix' => 'manager'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('manager.dashboard');
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/{id}/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::get('/{projectId}/task/{taskId}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/{projectId}/task/edit/{taskId}', [TaskController::class, 'edit'])->name('task.edit');
});

Route::group(['middleware' => ['role_or_permission:member|publish tasks'], 'prefix' => 'member'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/{projectId}/task/{taskId}', [TaskController::class, 'show'])->name('task.show');
});