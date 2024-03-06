<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Mail\verifyMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function homePage()
    {
        return view('frontend.pages.HomePage');
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
            ]);

            $randomNumber = mt_rand(10000000000000000000, 99999999999999999999);

            // Generate random string of 20 characters
            $randomString = Str::random(20);

            $details = [
                'otp' => $randomString,
            ];

            Mail::to($request->email)->send(new verifyMail($details));

            return redirect()->route('frontend.verification')->with('success', 'Registered! Please verify your email');

        } catch (\Exception $e) {

        }
    }

    public function verification()
    {

    }
}
