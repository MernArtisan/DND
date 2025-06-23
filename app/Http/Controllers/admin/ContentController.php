<?php

namespace App\Http\Controllers\admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::all();
        return view('admin.content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $content = Content::findOrFail($id);
        $content->update($request->all());

        return redirect()->route('content.index')->with('success', 'Content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function Privacy()
    {
        $privacy = Content::find(1);
        // dump($content);
        return view('admin.content.privacy', compact('privacy'));
    }

    public function updatePrivacy(Request $request)
    {
        $content = Content::find(1);

        $content->update($request->all());
        return redirect()->route('admin.privacy-policy')->with('success', 'Privacy Policy Upated');
    }


    public function Terms()
    {
        $terms = Content::find(2);
        // dump($content);
        return view('admin.content.terms', compact('terms'));
    }

    public function updateTerms(Request $request)
    {
        $content = Content::find(2);

        $content->update($request->all());
        return redirect()->route('admin.terms-condition')->with('success', 'Term & Conditon Updated');
    }
}
