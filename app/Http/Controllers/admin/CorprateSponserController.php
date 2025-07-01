<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CorprateSponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class CorprateSponserController extends Controller
{
    public function index()
    {
        $sponsors = CorprateSponser::orderBy('created_at', 'desc')->get();
        return view('admin.CorprateSponser.index', compact('sponsors'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.CorprateSponser.manage');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('corporate_sponsors', 'public');
            $validated['image'] = $path;
        }

        CorprateSponser::create($validated);

        return redirect()->route('admin.corporate-sponsors.index')
            ->with('success', 'Corporate sponsor created successfully!');
    }

    public function edit($encryptedId)
    {
        $id = decrypt($encryptedId);
        $sponsor = CorprateSponser::find($id);
        return view('admin.CorprateSponser.manage', [
            'sponsor' => $sponsor
        ]);
    }

    public function update(Request $request, $encryptedId)
    {
        // Decrypt the ID
        $id = Crypt::decrypt($encryptedId);
        $sponsor = CorprateSponser::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($sponsor->image && Storage::disk('public')->exists($sponsor->image)) {
                Storage::disk('public')->delete($sponsor->image);
            }

            // Store the new image
            $path = $request->file('image')->store('corporate_sponsors', 'public');
            $validated['image'] = $path;
        }

        // Update the sponsor details
        $sponsor->update($validated);

        return redirect()->route('admin.corporate-sponsors.index')
            ->with('success', 'Corporate sponsor updated successfully!');
    }

    public function destroy($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $sponsor = CorprateSponser::findOrFail($id);

            if ($sponsor->image && Storage::disk('public')->exists($sponsor->image)) {
                Storage::disk('public')->delete($sponsor->image);
            }

            $sponsor->delete();

            return redirect()->route('admin.corporate-sponsors.index')->with('success', 'corporate-sponsors deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
