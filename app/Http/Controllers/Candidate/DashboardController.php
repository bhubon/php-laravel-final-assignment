<?php

namespace App\Http\Controllers\Candidate;

use App\Models\Application;
use App\Models\CandidateJobExperience;
use App\Models\CandidateSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $applications = Application::where(['user_id' => $user->id])->with(['job'])->latest()->limit(5)->get();
        $success_applications = Application::where(['user_id' => $user->id,'status'=>'accepted'])->count();
        $experience = CandidateJobExperience::where(['candidate_id' => $user->candidate->id])->count();
        $skills = CandidateSkills::where(['candidate_id' => $user->candidate->id])->count();
        // dd($applied_jobs);
        return view('candidate.dashboard',['applications'=>$applications,'success_applications'=>$success_applications,'experience'=>$experience,'skills'=>$skills]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function applications()
    {
        $user_id = auth()->user()->id;
        $applications = Application::where(['user_id' => $user_id])->with(['job', 'job.company'])->latest()->paginate(10);
        return view('candidate.pages.applications', ['applications' => $applications]);
    }

    public function profile()
    {
        $user = auth()->user();
        $candidate = $user->candidate;
        return view('candidate.pages.profile', ['user' => $user, 'candidate' => $candidate]);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'fathers_name' => 'required|string|max:255',
            'mothers_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_group' => 'nullable|string|max:10',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_id' => 'nullable|string|max:255',
            'passport_no' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:255',
            'whatsapp_number' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'github_link' => 'nullable|url|max:255',
            'behance_link' => 'nullable|url|max:255',
            'portfolio_link' => 'nullable|url|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        try {

            DB::beginTransaction();

            $user = auth()->user();
            $candidate = $user->candidate;

            $img_url = $candidate->avatar;
            if ($request->hasFile('avatar')) {
                $img = $request->file('avatar');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img_url = "/uploads/{$img_name}";
                $img->move(public_path("uploads"), $img_name);

                $old_image = public_path($candidate->avatar);

                if (!empty($candidate->avatar)) {
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }
            }

            $pdf_url = $candidate->resume;
            if ($request->hasFile('resume')) {
                $img = $request->file('resume');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $pdf_name = "{$t}-{$fileName}";
                $pdf_url = "/uploads/{$pdf_name}";
                $img->move(public_path("uploads"), $pdf_name);

                $old_pdf = public_path($candidate->resume);

                if (!empty($candidate->resume)) {
                    if (file_exists($old_pdf)) {
                        unlink($old_pdf);
                    }
                }
            }

            $candidate->update([
                'name' => $request->input('full_name'),
                'fathers_name' => $request->input('fathers_name'),
                'mothers_name' => $request->input('mothers_name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'blood_group' => $request->input('blood_group'),
                'social_id' => $request->input('social_id'),
                'passport_no' => $request->input('passport_no'),
                'emergency_contact_number' => $request->input('phone_number'),
                'whatsapp_number' => $request->input('whatsapp_number'),
                'facebook_link' => $request->input('facebook_link'),
                'linkedin_link' => $request->input('linkedin_link'),
                'github_link' => $request->input('github_link'),
                'behance_link' => $request->input('behance_link'),
                'portfolio_link' => $request->input('portfolio_link'),
                'avatar' => $img_url,
                'resume' => $pdf_url,
            ]);

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);


            Db::commit();

            return redirect()->back()->with('success', 'Profile Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return redirect()->back()->with('warning', 'Something went wrong');

        }


    }
}
