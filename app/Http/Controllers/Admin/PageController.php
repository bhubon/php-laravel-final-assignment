<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.page.index', ['pages' => $pages]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::findOrFail($id);
        return view('admin.page.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $page = Page::findOrFail($id);
            $page->company_mission = $request->company_mission;
            $page->company_vission = $request->company_vision;
            $page->address = $request->address;
            $page->phone = $request->phone;
            $page->email = $request->email;

            $page->save();

            return redirect()->back()->with('success', 'Page Updated');
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('warning', 'Something went wrong');
        }
    }
}
