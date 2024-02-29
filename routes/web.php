<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Company\CompanyBlogController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\Company\JobController;
use App\Http\Controllers\Company\ProfileController;
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
    return view('welcome');
});

//Admin Logins
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});
//Admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {

    //Profile
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [DashboardController::class, 'adminLogout'])->name('admin.logout');

    //company
    Route::resource('/companies', CompanyController::class);
});



//Company
Route::get('/company/login', [CompanyDashboardController::class, 'login'])->name(('company.login'));

Route::middleware(['auth', 'verified', 'role:company'])->prefix('company')->group(function () {    
    Route::get('/dashboard', [CompanyDashboardController::class, 'dashboard'])->name('company.dashboard');
    Route::get('logout', [CompanyDashboardController::class, 'companyLogout'])->name(('company.logout'));

    //profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('company.profile');
    Route::post('/profile', [ProfileController::class, 'profileUpdate'])->name('company.profileUpdate');

    //Job
    Route::resource('jobs', JobController::class);
    //Blog
    Route::resource('blogs', CompanyBlogController::class);
});

//Candidate
Route::middleware(['auth', 'verified', 'role:candidate'])->group(function () {
    Route::get('/user/dashboard', function () {
        echo 'Candidate';
    });
});

require __DIR__ . '/auth.php';
