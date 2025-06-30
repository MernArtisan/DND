<?php

namespace App\Http\Controllers\admin;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('created_at', 'desc')->get();
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.manage');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('teams', 'public');
            $validated['image'] = $path;
        }

        Team::create($validated);

        return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully!');
    }
    public function edit($encryptedId)
    {
        $id = decrypt($encryptedId);
        $team = Team::find($id);
        return view('admin.teams.manage', [
            'team' => $team
        ]);
    }

    public function update(Request $request, $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $team = Team::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }

            $path = $request->file('image')->store('teams', 'public');
            $validated['image'] = $path;
        }

        $team->update($validated);

        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully!');
    }

    public function destroy($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $team = Team::findOrFail($id);

            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }

            $team->delete();

            return redirect()->route('admin.teams.index')->with('success', 'team deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
