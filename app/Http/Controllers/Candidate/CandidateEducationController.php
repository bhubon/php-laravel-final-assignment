<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\CanidateEducation;
use Illuminate\Http\Request;

class CandidateEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CanidateEducation::where('candidate_id', auth()->user()->candidate->id)->latest()->paginate(10);
        return view('candidate.education.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidate.education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'degree_type' => 'required|string',
            'institute_name' => 'required|string',
            'department' => 'required|string',
            'passing_year' => 'required|string',
            'cgpa' => 'required|string',
        ]);

        try {

            CanidateEducation::create([
                'candidate_id' => $request->user()->candidate->id,
                'degree_type' => $request->degree_type,
                'institute_name' => $request->institute_name,
                'department' => $request->department,
                'passing_year' => $request->passing_year,
                'cgpa' => $request->cgpa,
            ]);

            return redirect()->route('education.index')->with('success', 'Education Details Added');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = CanidateEducation::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

        if (!$item) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }

        return view('candidate.education.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'degree_type' => 'required|string',
            'institute_name' => 'required|string',
            'department' => 'required|string',
            'passing_year' => 'required|string',
            'cgpa' => 'required|string',
        ]);

        try {
            $item = CanidateEducation::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

            if (!$item) {
                return redirect()->back()->with('warning', 'Something went wrong');
            }
            $item->update([
                'degree_type' => $request->degree_type,
                'institute_name' => $request->institute_name,
                'department' => $request->department,
                'passing_year' => $request->passing_year,
                'cgpa' => $request->cgpa,
            ]);

            return redirect()->back()->with('success', 'Education Details Updated');
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
            $item = CanidateEducation::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

            $item->delete();

            return redirect()->route('education.index')->with('success', 'Experience Deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
