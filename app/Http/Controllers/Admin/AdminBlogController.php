<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate();
        return view('admin.blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.blogs.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'category_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $img_url = '';

            if ($request->hasFile('thumbnail')) {
                $img = $request->file('thumbnail');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img->move(public_path("uploads"), $img_name);
                $img_url = "/uploads/{$img_name}";
            }

            Blog::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'short_description' => $request->short_description,
                'thumbnail' => $img_url,
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
                'status' => 'active',
            ]);

            DB::commit();
            return redirect()->route('admin-blogs.index')->with('success', 'Blog Created.');
        } catch (\Error $error) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::latest()->get();
        $blog = Blog::where('id', $id)->with('category')->first();
        return view('admin.blogs.edit', ['categories' => $categories, 'blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $blog = Blog::findOrFail($id);

            $img_url = $blog->thumbnail;

            if ($request->hasFile('thumbnail')) {
                $img = $request->file('thumbnail');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $img_name = "{$t}-{$fileName}";
                $img->move(public_path("uploads"), $img_name);
                $img_url = "/uploads/{$img_name}";
            }

            $blog->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'short_description' => $request->short_description,
                'thumbnail' => $img_url,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Blog Updated.');
        } catch (\Error $error) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
