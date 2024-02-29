<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::with('company')->latest()->paginate(10);
        return view('admin.job.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job_categories = JobCategory::latest()->get();
        $job = Job::with('company')->findOrFail($id);
        return view('admin.job.edit', ['job' => $job, 'job_categories' => $job_categories]);
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
            'location' => 'required|string',
            'salary' => 'required',
            'job_type' => 'required',
            'vacancy' => 'required',
            'job_nature' => 'required',
            'deadline' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $job = Job::where(['id' => $id])->first();

            $job->update([
                'title' => $request->title,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'location' => $request->location,
                'salary' => $request->salary,
                'job_type' => $request->job_type,
                'vacancy' => $request->vacancy,
                'job_nature' => $request->job_nature,
                'deadline' => $request->deadline,
                'category_id' => $request->category_id,
                'status' => $request->status,
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
        //
    }
}
