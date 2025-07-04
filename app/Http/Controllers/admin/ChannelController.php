<?php

namespace App\Http\Controllers\admin;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $channels = Channel::with('streamer')->paginate(10);
            // return $channels;   
            return view('admin.channel.index', compact('channels'));
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
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Request $request)
    {
        try {
            $channel = Channel::findOrFail($request->id);
            $channel->is_active = !$channel->is_active;
            $channel->save();

            return response()->json([
                'success' => true,
                'status' => $channel->is_active ? 'Active' : 'Block',
                'buttonClass' => $channel->is_active ? 'btn-success' : 'btn-danger',
                'message' => 'Status Changed  Successfully'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
