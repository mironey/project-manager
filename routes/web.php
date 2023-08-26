<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Livewire\Assignment\AssignmentCreate;
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

Route::group(['middleware' => ['role_or_permission:super-admin|admin|manage projects'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
   
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('admin.project.show');
    Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('admin.project.edit');

    Route::get('/{id}/task/create', [TaskController::class, 'create'])->name('admin.task.create');
    Route::get('/{projectId}/task/{taskId}', [TaskController::class, 'show'])->name('admin.task.show');
    Route::get('/{projectId}/task/edit/{taskId}', [TaskController::class, 'edit'])->name('admin.task.edit');

    Route::get('/{projectId}/task/{taskId}/assignment/create', [AssignmentController::class, 'create'])->name('admin.assignment.create');
});

Route::group(['middleware' => ['role_or_permission:manager|manage tasks'], 'prefix' => 'manager'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('manager.dashboard');
    
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/{id}/task/create', [TaskController::class, 'create'])->name('manager.task.create');
    Route::get('/{projectId}/task/{taskId}', [TaskController::class, 'show'])->name('manager.task.show');
    Route::get('/{projectId}/task/edit/{taskId}', [TaskController::class, 'edit'])->name('manager.task.edit');

    Route::get('/{projectId}/task/{taskId}/assignment/create', [AssignmentController::class, 'create'])->name('manager.assignment.create');
});

Route::group(['middleware' => ['role_or_permission:supervisor|manage assignments'], 'prefix' => 'supervisor'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('supervisor.dashboard');
    Route::get('/{projectId}/task/{taskId}', [TaskController::class, 'show'])->name('supervisor.task.show');

    Route::get('/{projectId}/task/{taskId}/assignment/create', [AssignmentController::class, 'create'])->name('supervisor.assignment.create');
    Route::get('/{projectId}/task/{taskId}/assignment/{assignmentId}', [AssignmentController::class, 'show'])->name('supervisor.assignment.show');
    Route::get('/{projectId}/task/{taskId}/assignment/edit/{assignmentId}', [AssignmentController::class, 'edit'])->name('supervisor.assignment.edit');
});

Route::group(['middleware' => ['role_or_permission:member|publish assignments'], 'prefix' => 'member'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/{projectId}/task/{taskId}/assignment/{assignmentId}', [AssignmentController::class, 'show'])->name('member.assignment.show');
    Route::get('/{projectId}/task/{taskId}/assignment/submit/{assignmentId}', [AssignmentController::class, 'submit'])->name('member.assignment.submit');

});