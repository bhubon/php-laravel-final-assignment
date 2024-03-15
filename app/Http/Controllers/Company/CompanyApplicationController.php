<?php

namespace App\Http\Controllers\Company;

use App\Models\Job;
use App\Models\Company;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view job application')->only(['index']);
        $this->middleware('can:edit job application')->only(['edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $company_id = Company::where('id', $user->company->id)->pluck('id')->first();

        $applications = Application::query();

        if (!empty ($request->job_id)) {
            $applications->whereHas('job', function ($query) use ($request) {
                return $query->where('id', $request->job_id);
            });
        }

        if (!empty ($request->status)) {
            $applications->where('status', $request->status);
        }

        $applications = $applications->where(['company_id' => $company_id])->latest()->with(['job', 'user'])->paginate(10);
        $jobs = Job::where('company_id', $user->company->id)->select(['id', 'title'])->latest()->get();

        return view('company.applications.index', ['applications' => $applications, 'jobs' => $jobs]);
    }
    public function edit(string $id)
    {
        $application = Application::where('id', $id)->with('job', 'user', 'user.candidate', 'user.candidate.educations', 'user.candidate.trainings', 'user.candidate.skills', 'user.candidate.job_experiences')->first();
        return view('company.applications.details', ['application' => $application]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'action' => 'required'
        ]);

        try {
            $application = Application::findOrFail($id);

            $application->update([
                'status' => $request->action,
            ]);

            return redirect()->back()->with('success', 'Status Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something Went Wrong');
        }



    }
}
