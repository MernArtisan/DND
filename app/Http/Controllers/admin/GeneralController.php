<?php

namespace App\Http\Controllers\admin;

use App\Models\General;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     * Show the general settings form.
     */
    public function general()
    {
        $general = General::first(); // Assuming there's only one general record
        return view('admin.general.index', compact('general'));
    }


    public function edit()
    {
        $general = General::first(); // Assuming there's only one general record
        return view('admin.general.edit', compact('general'));
    }
    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'welcome' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'getintouch' => 'nullable|string|max:255',
            'copyright' => 'nullable|string|max:255',
            'dndsports' => 'nullable|string|max:255',
            'rights' => 'nullable|string|max:255',
            'mon-fri' => 'nullable|string|max:255',
            'sat' => 'nullable|string|max:255',
            'sun' => 'nullable|string|max:255',
            'map' => 'nullable|string',
        ]);

        // Update general settings
        $general = General::findOrFail(1);
        $general->update($request->only([
            'welcome',
            'description',
            'address',
            'phone',
            'email',
            'facebook',
            'twitter',
            'instagram',
            'youtube',
            'linkedin',
            'getintouch',
            'copyright',
            'dndsports',
            'rights',
            'mon-fri',
            'sat',
            'sun',
            'map',
        ]));

        return redirect()->back()->with('success', 'General settings updated successfully.');
    }
}
