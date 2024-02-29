<?php

namespace App\Http\Controllers\Company;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $blogs = Blog::where('user_id', $user_id)->latest()->paginate(10);
        return view('company.blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('company.blogs.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

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
                'user_id' => $user_id,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Blog Created.');
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
        try {
            $user_id = Auth::user()->id;
            $blog = Blog::where(['id' => $id, 'user_id' => $user_id])->first();
            $blog->delete();

            return redirect()->back()->with('success', 'Blog Deleted.');
        } catch (\Error $error) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Something went wrong');
        }

    }
}
