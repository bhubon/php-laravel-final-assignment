<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\CandidateSkills;
use Illuminate\Http\Request;

class CandidateskillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CandidateSkills::where(['candidate_id' => auth()->user()->candidate->id])->latest()->paginate(10);
        return view('candidate.skill.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidate.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string',
            'year' => 'required|string',
        ]);

        try {

            CandidateSkills::create([
                'candidate_id' => auth()->user()->candidate->id,
                'skill' => $request->skill_name,
                'passing_year' => $request->year,
            ]);

            return redirect()->route('skills.index')->with('success', 'Skill Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Somethin went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = CandidateSkills::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

        if (!$item) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }

        return view('candidate.skill.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'skill_name' => 'required|string',
            'year' => 'required|string',
        ]);

        try {
            $item = CandidateSkills::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

            $item->update([
                'skill' => $request->skill_name,
                'passing_year' => $request->year,
            ]);

            return redirect()->back()->with('success', 'Skill Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Somethin went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = CandidateSkills::where(['candidate_id' => auth()->user()->candidate->id, 'id' => $id])->first();

            $item->delete();

            return redirect()->route('skills.index')->with('success', 'Skill Deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Somethin went wrong');
        }
    }
}
