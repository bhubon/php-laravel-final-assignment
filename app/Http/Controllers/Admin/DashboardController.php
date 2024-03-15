<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view users')->only(['all_user']);
        $this->middleware('can:edit users')->only(['user_details', 'account_update']);
    }


    public function dashboard()
    {
        $jobs = Job::with('company')->latest()->limit(10)->get();
        $jobs_count = Job::count();
        $companies_count = Company::count();
        $candidates_count = Candidate::count();

        return view('admin.dashboard', ['jobs' => $jobs, 'jobs_count' => $jobs_count, 'companies_count' => $companies_count, 'candidates_count' => $candidates_count]);
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function all_user()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    public function user_details(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function candidate_details(string $id)
    {
        $user = User::findOrFail($id);
        $candidate = $user->candidate;
        return view('admin.users.candidate-details', ['user' => $user, 'candidate' => $candidate]);
    }

    public function account()
    {
        $user = auth()->user();
        return view('admin.admin-profile', ['user' => $user]);
    }

    public function account_update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'avatar' => 'nullable',
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed|required_with:current_password',
        ]);

        try {
            $user = auth()->user();

            if (!empty($request->current_password)) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect'])->withInput();
                } else {
                    $user->password = Hash::make($request->password);
                }
            }

            $img_url = $user->avatar;
            if ($request->hasFile('avatar')) {
                $img = $request->file('avatar');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img_url = "/uploads/{$img_name}";
                $img->move(public_path("uploads"), $img_name);

                $old_image = public_path($user->avatar);

                if (!empty($candidate->avatar)) {
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->avatar = $img_url;



            $user->save();

            return redirect()->back()->with('success', 'Profile Updated');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
