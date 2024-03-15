<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:view company profile')->only(['profile']);
        $this->middleware('can:edit company profile')->only(['profileUpdate']);
    }

    public function profile(Request $request)
    {
        $user_id = $request->user()->id;
        $user = User::where('id', $user_id)->with('company')->first();
        return view('company.profile.profile', ['user' => $user]);
    }

    public function profileUpdate(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'company_name' => 'required|string',
                'company_address' => 'required|string',
                'company_phone' => 'required|string',
                'company_email' => 'required|string',
            ]);

            $user_id = $request->user()->id;
            $user = User::findOrFail($user_id);

            $company = Company::where('id', auth()->user()->company->id)->first();

            $company->company_name = $request->input('company_name');
            $company->company_address = $request->input('company_address');
            $company->company_phone = $request->input('company_phone');
            $company->company_email = $request->input('company_email');
            $company->company_website = $request->input('company_website');
            $company->industry = $request->input('industry');
            $company->company_size = $request->input('company_size');

            $company->facebook_links = $request->input('facebook_links');
            $company->linkedin_link = $request->input('linkedin_link');

            if ($request->hasFile('logo')) {
                $img = $request->file('logo');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img_url = "/uploads/{$img_name}";
                $img->move(public_path("uploads"), $img_name);

                $old_image = public_path($company->logo);

                $company->logo = $img_url;

                if (file_exists($old_image) && !empty ($company->logo)) {
                    unlink($old_image);
                }
            }

            if ($request->hasFile('cover_photo')) {
                $img = $request->file('cover_photo');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img_url = "/uploads/{$img_name}";
                $img->move(public_path("uploads"), $img_name);

                $old_image = public_path($company->cover_photo);

                $company->cover_photo = $img_url;

                if (file_exists($old_image) && !empty ($company->logo)) {
                    unlink($old_image);
                }
            }

            $company->save();

            DB::commit();
            return redirect()->back()->with('success', 'Profile Updated');
        } catch (\Error $error) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong');
        }



    }

    public function account_settings()
    {
        $user = auth()->user();
        return view('company.profile.account-settings', ['user' => $user]);
    }

    public function account_settings_update(Request $request)
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

            if (!empty ($request->current_password)) {
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

                if (!empty ($candidate->avatar)) {
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

            return redirect()->back()->with('success', 'Account Settings Updated');

        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }


}
