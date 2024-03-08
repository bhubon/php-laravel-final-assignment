<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Application;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\User;
use App\Mail\verifyMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function homePage()
    {
        $jobs_categories = JobCategory::with('jobs')->latest()->limit(8)->get();
        $jobs = Job::latest()->limit(5)->with(['company'])->get();
        return view('frontend.pages.HomePage', ['jobs' => $jobs, 'jobs_categories' => $jobs_categories]);
    }

    public function frontendLogin()
    {
        return view('frontend.pages.LoginPage');
    }

    public function frontendRegister()
    {
        return view('frontend.pages.RegisterPage');
    }

    public function frontendRegisterSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed'
        ]);

        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'role' => 'candidate',
                'status' => 'active',
            ]);

            if ($user) {
                $credentials = $request->only('email', 'password');

                Auth::attempt($credentials);

                return redirect()->route('user.dashboard')->with('success', 'Successfully Registered!');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }


        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }

    public function verification()
    {

    }

    public function allJobs()
    {
        $jobs_categories = JobCategory::with('jobs')->latest()->limit(8)->get();
        $jobs = Job::where(['status' => 'active'])->latest()->limit(5)->with(['company'])->paginate(10);
        return view('frontend.pages.AllJobs', ['jobs' => $jobs, 'jobs_categories' => $jobs_categories]);
    }

    public function jodDetails(string $id)
    {
        $job = Job::where(['id' => $id, 'status' => 'active'])->with(['company'])->first();
        return view('frontend.pages.JobDetails', ['job' => $job]);
    }

    public function applyJob(string $id)
    {
        try {
            $job = Job::where(['id' => $id, 'status' => 'active'])->with(['company'])->first();

            if (!$job) {
                return redirect()->back()->with('warning', 'Job Not Found');
            }

            $user_id = auth()->user()->id;
            $user = User::where('id', $user_id)->with(['candidate'])->first();

            $candidate = $user->candidate;

            $requiredFields = [
                'name',
                'fathers_name',
                'mothers_name',
                'date_of_birth',
                'blood_group',
                'passport_no',
                'emergency_contact_number',
                'resume',
            ];

            foreach ($requiredFields as $field) {
                if (empty($candidate->{$field})) {
                    return redirect()->back()->with('warning', 'Please fill all required fields');
                }
            }

            $educations = $candidate->educations;

            if (count($educations) == 0) {
                return redirect()->back()->with('warning', 'Please fill all required fields');
            }

            $skils = $candidate->skills;

            if (count($skils) == 0) {
                return redirect()->back()->with('warning', 'Please fill all required fields');
            }

            Application::create([
                'job_id' => $id,
                'user_id' => $user_id,
                'company_id' => $job->company->id,
            ]);

            return redirect()->back()->with('success', 'Successfully Applied');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }


    }
}
