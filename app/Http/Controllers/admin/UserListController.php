<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserListController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        // dd(
        //     $users->pluck('image')
        // );
        return view('admin.user.user-list-index',  compact('users'));
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

    public function details(Request $request)
    {
        $user = User::where('id', $request->id)
            ->where('role', 'user')
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Found',
            'data' => $user
        ]);
    }


    public function destroy($encryptedId)
    {
        try {

            $id = Crypt::decrypt($encryptedId);
            $user = User::where('role', 'user')->findOrFail($id);

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
}
