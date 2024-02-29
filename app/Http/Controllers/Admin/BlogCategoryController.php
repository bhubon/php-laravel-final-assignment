<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.blog-category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255,unique:categories,name'
        ]);

        try {
            Category::create([
                'name' => $request->name,
            ]);
            return redirect()->route('blog-category.index')->with('success', 'Category Created');
        } catch (\Error $e) {
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.blog-category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
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
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->back()->with('success', 'Category Deleted');
        } catch (\Error $e) {
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }
}
