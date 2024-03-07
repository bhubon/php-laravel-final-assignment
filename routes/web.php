<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Company\CompanyApplicationController;
use App\Http\Controllers\Company\CompanyBlogController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\Company\JobController;
use App\Http\Controllers\Company\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
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

//frontend
Route::get('/', [HomeController::class, 'homePage'])->name('frontend.home');
Route::get('/flogin', [HomeController::class, 'frontendLogin'])->name('frontend.login');
Route::get('/fregistration', [HomeController::class, 'frontendRegister'])->name('frontend.registration');
Route::post('/registration', [HomeController::class, 'frontendRegisterSubmit'])->name('frontend.registrationSubmit');
Route::post('/verification', [HomeController::class, 'verification'])->name('frontend.verification');



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
    //job category
    Route::resource('/job-category', JobCategoryController::class);
    //Jobs
    Route::get('/jobs', [AdminJobController::class, 'index'])->name('admin.jobs.index');
    Route::get('/jobs/edit/{id}', [AdminJobController::class, 'edit'])->name('admin.jobs.edit');
    Route::put('/jobs/edit/{id}', [AdminJobController::class, 'update'])->name('admin.jobs.update');

    //blog category
    Route::resource('/blog-category', BlogCategoryController::class);
    //blog category
    Route::resource('/admin-blogs', AdminBlogController::class);
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
    //Blog
    Route::resource('applications', CompanyApplicationController::class);
});

//Candidate
Route::middleware(['auth', 'verified', 'role:candidate'])->group(function () {
    Route::get('/user/dashboard', function () {
        echo 'Candidate';
    })->name('user.dashboard');
});

require __DIR__ . '/auth.php';
