<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:view companies')->only(['index']);
        $this->middleware('can:edit companies')->except(['index', 'edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies = Company::query();
        if (!empty($request->status)) {
            $companies->whereHas('user', function ($query) use ($request) {
                $query->where('status', $request->status);
            });
        }
        $companies = $companies->with('user')->latest()->paginate();
        return view('admin.company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'company_name' => 'required|string',
                'company_address' => 'required|string',
                'company_phone' => 'required|string',
                'company_email' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required|string',
                'user_id' => 'required',
                'status' => 'required',
            ]);

            $user_id = $request->user_id;
            $user = User::findOrFail($user_id);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            $company = Company::where('user_id', $user_id)->first();

            $company->company_name = $request->input('company_name');
            $company->company_address = $request->input('company_address');
            $company->company_phone = $request->input('company_phone');
            $company->company_email = $request->input('company_email');
            $company->company_website = $request->input('company_website');
            $company->industry = $request->input('industry');
            $company->company_size = $request->input('company_size');

            $company->facebook_links = $request->input('facebook_links');
            $company->linkedin_link = $request->input('linkedin_link');
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

                if (file_exists($old_image) && !empty($company->logo)) {
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

                if (file_exists($old_image) && !empty($company->logo)) {
                    unlink($old_image);
                }
            }

            $company->save();

            DB::commit();
            return redirect()->back()->with('success', 'Company Profile Updated');
        } catch (\Error $error) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
