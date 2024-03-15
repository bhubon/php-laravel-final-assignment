<?php

namespace App\Http\Controllers\Company;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $jobs = Job::where('company_id', $user->company->id)->limit(5)->latest()->get();
        $total_jobs = Job::where('company_id', $user->company->id)->count();
        $total_employe = User::where('added_by',$user->added_by)->count();
        $application_count = Application::where('company_id', $user->company->id)->count();
        return view('company.dashboard', ['jobs' => $jobs, 'total_jobs' => $total_jobs, 'total_employe' => $total_employe, 'application_count' => $application_count]);
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
