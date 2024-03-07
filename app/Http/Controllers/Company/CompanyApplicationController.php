<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $company_id = Company::where(['user_id' => $user_id])->pluck('id')->first();
        $applications = Application::where(['company_id' => $company_id])->latest()->with(['job', 'user'])->paginate(10);
        return view('company.applications.index', ['applications' => $applications]);
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
