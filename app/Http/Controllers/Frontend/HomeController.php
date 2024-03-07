<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Job;
use App\Models\User;
use App\Mail\verifyMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function homePage()
    {
        $jobs = Job::latest()->limit(5)->with(['company'])->get();
        return view('frontend.pages.HomePage', ['jobs' => $jobs]);
    }

    public function frontendLogin()
    {
        return view('frontend.pages.LoginPage');
    }

    public function frontendRegister()
    {
        return view('frontend.pages.RegisterPage');
    }

    public function frontendRegisterSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed'
        ]);

        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'role' => 'candidate',
                'status' => 'active',
            ]);

            if ($user) {
                $credentials = $request->only('email', 'password');

                Auth::attempt($credentials);

                return redirect()->route('user.dashboard')->with('success', 'Successfully Registered!');
            } else {
                return redirect()->back()->with('warning', 'Something went wrong');
            }


        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }

    public function verification()
    {

    }
}
