<?php

namespace App\Http\Controllers\admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.content.index');
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
<<<<<<< HEAD
    public function edit($id)
    {
=======
    public function edit($encryptedId)
    {
        $id = decrypt($encryptedId);
>>>>>>> origin/moiz
        $cms_content = Content::findOrFail($id); // ✅ Single model, not a collection
        return view('admin.content.edit', compact('cms_content'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $encryptedId)
    // {
    //     $id = decrypt($encryptedId);
    //     $cms_content = Content::findOrFail($id);

    //     $request->validate([
    //         'name' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);
    //     $cms_content->update($request->except('_token', '_method'));

    //     return redirect()->route('admin.content.index')->with('success', 'Content updated successfully!');
    // }

    public function update(Request $request, string $id)
    {
        $content = Content::findOrFail($id);

        if ($request->hasFile('image')) {
            // Optional: delete old image
            if ($content->image && Storage::disk('public')->exists($content->image)) {
                Storage::disk('public')->delete($content->image);
            }

            $path = $request->file('image')->store('contents', 'public'); // uploads to storage/app/public/contents
            $content->image = $path; // save path directly
        }

        $content->update($request->except('image'));

        return redirect()->route('admin.content.index')->with('success', 'Content Updated Successfully');
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
        return redirect()->route('admin.terms-condition')->with('success', 'Term & Conditions Updated');
    }
}
