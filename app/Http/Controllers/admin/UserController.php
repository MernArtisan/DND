<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::where('role', 'streamer')->get();
            return view('admin.user.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        try {

            $id = Crypt::decrypt($encryptedId);
            $user = User::where('role', 'streamer')->findOrFail($id);

            // Optional: delete related channels, streams, etc. if needed
            // $user->channel()->delete();
            // $user->stream()->delete();
            // $user->savedHighLights()->detach();

            $user->delete();

            return redirect()->back()->with('success', 'Streamer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function details(Request $request)
    {
        // dd("abc");
        $user = User::with(['channel', 'stream'])
            ->where('id', $request->id)
            ->where('role', 'streamer')
            ->first();


        if (!$user) {
            return response()->json(['error' => false, 'message' => 'Streamer not found']);
        }

        // dd($user);

        return response()->json([
            'success' => true,
            'message' => 'Streamer Found',
            'data' => $user
        ]);
    }

    public function toggleStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->is_active ? 'Active' : 'Block',
            'buttonClass' => $user->is_active ? 'btn-success' : 'btn-danger',
            'message' => 'Status Changed  Successfully'
        ]);
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('admin.user.show', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.user.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'dob' => 'nullable|date',
                'country' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'city' => 'nullable|string|max:100',
                'zipcode' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'website' => 'nullable|url',
                'facebook' => 'nullable|url',
                'twitter' => 'nullable|url',
                'linkedin' => 'nullable|url',
                'image' => 'nullable|image|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->only([
                'name',
                'phone',
                'dob',
                'country',
                'state',
                'city',
                'zipcode',
                'address',
                'bio',
                'website',
                'facebook',
                'twitter',
                'linkedin'
            ]);

            if ($request->hasFile('image')) {
                // delete old image
                if ($user->image && Storage::disk('public')->exists(str_replace('storage/', '', $user->image))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $user->image));
                }

                $path = $request->file('image')->store('users', 'public'); // same as article logic
                $data['image'] = 'storage/' . $path;
            }

            $user->update($data);

            return redirect()->route('admin.showProfile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
