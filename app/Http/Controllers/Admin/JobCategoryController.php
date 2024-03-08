<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = JobCategory::orderBy('id', 'DESC')->paginate(10);
        return view('admin.job-category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255,unique:job_categories,name'
        ]);

        try {
            $img_url = '';
            if ($request->hasFile('icon')) {
                $img = $request->file('icon');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img_url = "/uploads/{$img_name}";
                $img->move(public_path("uploads"), $img_name);
            }

            JobCategory::create([
                'name' => $request->name,
                'icon' => $img_url,
            ]);
            return redirect()->route('job-category.index')->with('success', 'Category Created');
        } catch (\Error $e) {
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = JobCategory::findOrFail($id);
        return view('admin.job-category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name,' . $id,
        ]);

        try {
            $category = JobCategory::findOrFail($id);

            $img_url = $category->icon;

            if ($request->hasFile('icon')) {
                $img = $request->file('icon');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img_url = "/uploads/{$img_name}";
                $img->move(public_path("uploads"), $img_name);

                if (!empty($category->icon)) {
                    $old_image = public_path($category->icon);
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }
            }

            $category->update([
                'name' => $request->name,
                'icon' => $img_url,
            ]);
            return redirect()->back()->with('success', 'Category Updated');
        } catch (\Error $e) {
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = JobCategory::findOrFail($id);
            if (!empty($category->icon)) {
                $old_image = public_path($category->icon);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $category->delete();

            return redirect()->back()->with('success', 'Category Deleted');
        } catch (\Error $e) {
            return redirect()->back()->with('failed', 'Something went wrong');
        }

    }
}
