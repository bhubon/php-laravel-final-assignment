<?php

namespace App\Http\Controllers\Company;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    public function dashboard()
    {
        $user_id = auth()->user()->id;
        $jobs = Job::where('user_id', $user_id)->limit(5)->latest()->get();
        $total_jobs = Job::where('user_id', $user_id)->count();
        $total_employe = 0;
        $job_running = 0;
        return view('company.dashboard', ['jobs' => $jobs, 'total_jobs' => $total_jobs, 'total_employe' => $total_employe, 'job_running' => $job_running]);
    }

    public function companyLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/company/login');
    }

    public function login()
    {
        if (!auth()->check()) {
            return view('company.auth.login');
        } else {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->role === 'company') {
                return redirect()->route('company.dashboard');
            } else {

                return redirect()->route('user.dashboard');
            }
        }

    }
}
