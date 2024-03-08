<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\CandidateTrainings;
use Illuminate\Http\Request;

class CandidateTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CandidateTrainings::where(['candidate_id' => auth()->user()->candidate->id])->latest()->paginate(10);
        return view('candidate.training.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidate.training.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'training_name' => 'required|string',
            'institute_name' => 'required|string',
            'passing_year' => 'required|string',
        ]);

        try {
            CandidateTrainings::create([
                'candidate_id' => auth()->user()->candidate->id,
                'training_name' => $request->training_name,
                'institute_name' => $request->institute_name,
                'passing_year' => $request->passing_year,
            ]);

            return redirect()->route('trainings.index')->with('success', 'Trainig Added');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = CandidateTrainings::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();
        return view('candidate.training.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'training_name' => 'required|string',
            'institute_name' => 'required|string',
            'passing_year' => 'required|string',
        ]);

        try {
            $item = CandidateTrainings::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

            $item->update([
                'training_name' => $request->training_name,
                'institute_name' => $request->institute_name,
                'passing_year' => $request->passing_year,
            ]);

            return redirect()->back()->with('success', 'Trainig Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = CandidateTrainings::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

            $item->delete();

            return redirect()->route('trainings.index')->with('success', 'Trainig Deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
