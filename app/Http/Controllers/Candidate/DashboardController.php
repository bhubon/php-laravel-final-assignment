<?php

namespace App\Http\Controllers\Candidate;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('candidate.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function applications()
    {
        $user_id = auth()->user()->id;
        $applications = Application::where(['user_id' => $user_id])->with(['job', 'job.company'])->latest()->paginate(10);
        return view('candidate.pages.applications', ['applications' => $applications]);
    }

    public function job_experience()
    {
        
    }
}
