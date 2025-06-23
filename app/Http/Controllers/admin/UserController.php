<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

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
}
