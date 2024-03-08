<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\CandidateJobExperience;
use Illuminate\Http\Request;

class JobExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CandidateJobExperience::where(['candidate_id' => auth()->user()->candidate->id])->latest()->paginate(10);
        return view('candidate.jobExperience.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidate.jobExperience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required|string',
            'company_name' => 'required|string',
            'joining_date' => 'required',
        ]);

        try {
            CandidateJobExperience::create([
                'candidate_id' => auth()->user()->candidate->id,
                'designation' => $request->designation,
                'company_name' => $request->company_name,
                'joining_date' => $request->joining_date,
                'departure_date' => $request->departure_date,
            ]);

            return redirect()->route('user.job.experiences')->with('success', 'Experience Added');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function edit(string $id)
    {
        $item = CandidateJobExperience::where(['id' => $id, 'candidate_id' => auth()->user()->candidate->id])->first();
        return view('candidate.jobExperience.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'designation' => 'required|string',
            'company_name' => 'required|string',
            'joining_date' => 'required',
        ]);

        try {

            $experience = CandidateJobExperience::where(['id' => $id, 'candidate_id' => auth()->user()->candidate->id])->first();
            $experience->update([
                'designation' => $request->designation,
                'company_name' => $request->company_name,
                'joining_date' => $request->joining_date,
                'departure_date' => $request->departure_date,
            ]);

            return redirect()->back()->with('success', 'Experience Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = CandidateJobExperience::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

            $item->delete();

            return redirect()->route('user.job.experiences')->with('success', 'Experience Deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
