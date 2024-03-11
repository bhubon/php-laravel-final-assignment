<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use App\Mail\verifyMail;
use App\Models\Application;
use App\Models\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function homePage()
    {
        $jobs_categories = JobCategory::with('jobs')->latest()->limit(8)->get();
        $jobs = Job::with(['company'])->latest()->limit(5)->get();
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

    public function companyRegistration()
    {
        return view('frontend.pages.Company-Registration');
    }

    public function frontendCompanyRegisterSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_type' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed'
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'role' => 'company',
                'status' => 'inactive',
            ]);

            Company::create([
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'company_type' => $request->company_type,
            ]);

            $credentials = $request->only('email', 'password');

            Auth::attempt($credentials);

            DB::commit();

            return redirect()->route('user.dashboard')->with('success', 'Successfully Registered!');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }

    public function verification()
    {

    }

    public function allJobs(Request $request)
    {
        $jobs_categories = JobCategory::with('jobs')->latest()->limit(8)->get();
        $jobs = Job::where(['status' => 'active'])->latest()->with(['company'])->paginate(10);
        $jobs = Job::query();

        if (isset($request->title) && !empty($request->title)) {
            $title = isset($request->title) && !empty($request->title) ? trim($request->title) : '';
            $jobs->where('title', 'LIKE', "%{$title}%");
        }

        if (isset($request->job_type) && !empty($request->job_type)) {
            $job_type = isset($request->job_type) && !empty($request->job_type) ? $request->job_type : '';

            $jobs->where(['job_type' => $job_type]);
        }

        if (isset($request->category) && !empty($request->category)) {
            $category = isset($request->category) && !empty($request->category) ? $request->category : '';

            $jobs->where(['category_id' => $category]);
        }

        $filteredJobs = $jobs->where(['status' => 'active'])->latest()->with(['company'])->paginate(10);
        ;

        return view('frontend.pages.AllJobs', ['jobs' => $filteredJobs, 'jobs_categories' => $jobs_categories]);
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
