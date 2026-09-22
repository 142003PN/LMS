<?php

use App\Http\Controllers\HeadTeacherController;
use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/', 'login')->name('login');
    Route::get('/login', fn () => redirect()->route('login'));
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1')->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function (Request $request) {
        $route = $request->user()->dashboard_route_name();

        return $route === 'dashboard' ? view('dashboard') : redirect()->route($route);
    })->name('dashboard');

    Route::get('/head/dashboard', [HeadTeacherController::class, 'index'])->name('head_teacher.dashboard');
    Route::resource('head', HeadTeacherController::class)->only('index');

    foreach ([User::HOD => 'hod.dashboard', User::TEACHER => 'teacher.dashboard', User::LEARNER => 'learners.dashboard'] as $role => $name) {
        Route::get('/'.$role.'/dashboard', function (Request $request) use ($role) {
            abort_unless($request->user()->role === $role, 403);

            return view('dashboard');
        })->name($name);
    }
});
