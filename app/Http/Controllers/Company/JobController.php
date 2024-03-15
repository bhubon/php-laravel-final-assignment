<?php

namespace App\Http\Controllers\Company;

use App\Models\Job;
use App\Models\User;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view jobs')->only(['index']);
        $this->middleware('can:edit jobs')->only(['edit', 'update']);
        $this->middleware('can:delete jobs')->only(['destroy']);
        $this->middleware('can:create jobs')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        $jobs = Job::query();

        if (!empty ($request->status)) {
            $jobs->where('status', $request->status);
        }



        if (!empty ($request->month)) {

            $date = $request->month;
            $date = explode('-', $date);
            $inputMonth = $date[1];
            $inputYear = $date[0];

            $jobs->whereYear('created_at', $inputYear)
                ->whereMonth('created_at', $inputMonth);
        }

        $jobs = $jobs->where('company_id', Auth::user()->company->id)->latest()->with(['applications'])->paginate(10);
        return view('company.jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $job_categories = JobCategory::latest()->get();
        return view('company.jobs.create', ['job_categories' => $job_categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'requirements' => 'required',
            'skills' => 'required',
            'location' => 'required|string',
            'salary' => 'required',
            'job_type' => 'required',
            'vacancy' => 'required',
            'job_nature' => 'required',
            'deadline' => 'required',
            'category_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->with('company')->first();
            $company_id = $user->company->id;

            Job::create([
                'title' => $request->title,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'skills' => $request->skills,
                'location' => $request->location,
                'salary' => $request->salary,
                'job_type' => $request->job_type,
                'vacancy' => $request->vacancy,
                'job_nature' => $request->job_nature,
                'deadline' => $request->deadline,
                'status' => 'inactive',
                'company_id' => $company_id,
                'category_id' => $request->category_id,
                'user_id' => $user_id,
            ]);
            DB::commit();

            return redirect()->route('jobs.index')->with('success', 'Job Created.');

        } catch (\Error $error) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company_id = auth()->user()->company->id;
        $job = Job::where(['id' => $id, 'company_id' => $company_id])->first();
        $job_categories = JobCategory::latest()->get();
        return view('company.jobs.edit', ['job' => $job, 'job_categories' => $job_categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'requirements' => 'required',
            'skills' => 'required',
            'location' => 'required|string',
            'salary' => 'required',
            'job_type' => 'required',
            'vacancy' => 'required',
            'job_nature' => 'required',
            'deadline' => 'required',
            'category_id' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $company_id = auth()->user()->company->id;
            $job = Job::where(['id' => $id, 'company_id'=>$company_id])->first();

            $job->update([
                'title' => $request->title,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'skills' => $request->skills,
                'location' => $request->location,
                'salary' => $request->salary,
                'job_type' => $request->job_type,
                'vacancy' => $request->vacancy,
                'job_nature' => $request->job_nature,
                'deadline' => $request->deadline,
                'category_id' => $request->category_id,
            ]);
            DB::commit();

            return redirect()->back()->with('success', 'Job Updated.');

        } catch (\Error $error) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_id = Auth::user()->id;
        $job = Job::where(['id' => $id, 'company_id'=>Auth::user()->company->id])->first();
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job Deleted.');
    }
}
