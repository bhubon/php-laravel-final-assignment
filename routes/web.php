<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Candidate\CandidateEducationController;
use App\Http\Controllers\Candidate\CandidateskillsController;
use App\Http\Controllers\Candidate\JobExperience;
use App\Http\Controllers\Candidate\JobExperienceController;
use App\Http\Controllers\Candidate\CandidateTrainingController;
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
Route::get('/company-registration', [HomeController::class, 'companyRegistration'])->name('frontend.registration.company');
Route::post('/company-registration', [HomeController::class, 'frontendCompanyRegisterSubmit'])->name('frontend.company.registrationSubmit');
Route::post('/registration', [HomeController::class, 'frontendRegisterSubmit'])->name('frontend.registrationSubmit');
Route::post('/verification', [HomeController::class, 'verification'])->name('frontend.verification');
Route::get('/jobs', [HomeController::class, 'allJobs'])->name('frontend.jobs');
Route::get('/jobs/{id}', [HomeController::class, 'jodDetails'])->name('frontend.jobs.details');
Route::post('/jobs/apply/{id}', [HomeController::class, 'applyJob'])->name('frontend.jobs.apply');



//Admin Logins
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});
//Admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {

    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [DashboardController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/users', [DashboardController::class, 'all_user'])->name('admin.users');
    Route::get('/users/{id}', [DashboardController::class, 'user_details'])->name('admin.users.details');
    Route::get('/candidate/{id}', [DashboardController::class, 'candidate_details'])->name('admin.candidate.details');
    //Profile
    Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [DashboardController::class, 'profile_update'])->name('admin.profile.update');
    
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
    Route::get('/user/dashboard', [App\Http\Controllers\Candidate\DashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/logout', [App\Http\Controllers\Candidate\DashboardController::class, 'logout'])->name('user.logout');

    Route::get('/user/applications', [App\Http\Controllers\Candidate\DashboardController::class, 'applications'])->name('user.applications');
    Route::get('/user/profile', [App\Http\Controllers\Candidate\DashboardController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile', [App\Http\Controllers\Candidate\DashboardController::class, 'profileUpdate'])->name('user.profile.update');

    //job experiences
    Route::get('/user/job-experiences', [JobExperienceController::class, 'index'])->name('user.job.experiences');

    Route::get('/user/job-experiences/create', [JobExperienceController::class, 'create'])->name('user.job.experiences.create');
    Route::post('/user/job-experiences/create', [JobExperienceController::class, 'store'])->name('user.job.experiences.store');

    Route::get('/user/job-experiences/{id}', [JobExperienceController::class, 'edit'])->name('user.job.experiences.edit');
    Route::put('/user/job-experiences/{id}', [JobExperienceController::class, 'update'])->name('user.job.experiences.update');

    Route::delete('/user/job-experiences/{id}', [JobExperienceController::class, 'destroy'])->name('user.job.experiences.delete');

    //trainig
    Route::resource('/user/trainings', CandidateTrainingController::class);
    //Education
    Route::resource('/user/education', CandidateEducationController::class);
    //Skill
    Route::resource('/user/skills', CandidateskillsController::class);
});

require __DIR__ . '/auth.php';
