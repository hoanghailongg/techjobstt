<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\FollowingController;
use App\Http\Controllers\Admin\TelegramController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employer\EmployerFollowingController;
use App\Http\Controllers\Employer\EmployerJobController;
use App\Http\Controllers\Employer\EmployerLoginController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('auth/login', [LoginController::class, 'index'])->name('login');
Route::post('auth/login', [LoginController::class, 'store']);
Route::get('auth/register', [LoginController::class, 'register'])->name('register');
Route::post('auth/register/store', [LoginController::class, 'registerAction'])->name('register.store');
Route::get('viec-lam/xem-chi-tiet-{job}', [JobController::class, 'index'])->name('view.job');
Route::get('jobs/search', [JobController::class, 'search'])->name('jobs.search');

Route::middleware('auth:web,admin,employer')->group(function () {
    Route::post('jobs/search/apply', [JobController::class, 'apply'])->name('jobs.submit');
    Route::get('trang-ca-nhan', [HomeController::class, 'profile'])->name('profile');
    Route::post('trang-ca-nhan/update', [HomeController::class, 'update'])->name('profile.update');
    #Logout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});


/**
 * Route for admin.
 */
Route::middleware(['guest:admin'])->group(function () {
    Route::get('admin/auth/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('admin/auth/login', [AdminLoginController::class, 'store']);
});

Route::middleware(['auth:admin'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('dashboard');
            Route::get('dashboard', [AdminController::class, 'index']);

            #Follows
            Route::get('follow', [FollowingController::class, 'index'])->name('follow.index');
            Route::get('follow/show/{follow}',[FollowingController::class,'showStatus'])->name('follow.show-status');
            Route::post('follow/status',[FollowingController::class,'updateStatus'])->name('follow.update-status');

            #Users
            Route::get('users', [AdminController::class, 'listUser'])->name('users.index');
            Route::patch('users/update', [AdminController::class, 'updateUser'])->name('users.update');
            Route::delete('users/destroy/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

            #Posts
            Route::resource('posts', PostController::class);

            #Jobs
            Route::resource('jobs', AdminJobController::class);
            Route::get('jobs/show-status/{job}', [AdminJobController::class, 'showStatus'])->name('jobs.show-status');
            Route::post('jobs/show-status/update',[AdminJobController::class,'updateStatus'])->name('jobs.update-status');
            #Companies
            Route::resource('employers', CompanyController::class);

            #Logout
            Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

            Route::get('updated-activity',[TelegramController::class, 'updatedActivity']);

            #Clear cache
            Route::get('create_symlink', function () {
                $exitCode = Artisan::call('storage:link');
                return 'storage:link command executed';
            });

            Route::get('clear_cache', function () {
                $exitCode = Artisan::call('cache:clear');
                return 'cache:clear command executed';
            });
        });
    });
});


/**
 * Route for employer.
 */
Route::middleware(['guest:employer'])->group(function () {
    Route::get('employer/auth/login', [EmployerLoginController::class, 'index'])->name('employer.login');
    Route::post('employer/auth/login', [EmployerLoginController::class, 'store']);
    Route::get('employer/auth/register', [EmployerLoginController::class, 'register'])->name('employer.register');
    Route::post('employer/auth/register/store', [EmployerLoginController::class, 'registerAction'])->name('employer.register.store');
});

Route::middleware(['auth:employer'])->group(function () {
    Route::name('employer.')->group(function () {
        Route::prefix('employer')->group(function () {
            Route::get('/', [EmployerController::class, 'index'])->name('dashboard');
            #Follows
            Route::get('follow', [EmployerFollowingController::class, 'index'])->name('follow.index');
            Route::get('follow/show/{follow}',[EmployerFollowingController::class,'showStatus'])->name('follow.show-status');
            Route::post('follow/status',[EmployerFollowingController::class,'updateStatus'])->name('follow.update-status');
            Route::get('follow/detail/{follow}',[EmployerFollowingController::class, 'showDetail'])->name('follow.detail');
            #Jobs
            Route::resource('jobs', EmployerJobController::class);
            #Profile
            Route::resource('profile',EmployerProfileController::class);
            #Logout
            Route::post('logout', [EmployerLoginController::class, 'logout'])->name('logout');
        });
    });
});
