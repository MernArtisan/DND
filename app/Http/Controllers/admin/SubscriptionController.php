<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = SubscriptionPlan::orderBy("created_at", "desc")->paginate(10);
        return view('admin.subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'billing_cycle' => 'required|in:day,month,annual',
                'duration_unit' => 'nullable|integer|min:3',
                'duration_value' => 'nullable|integer|min:1',
                'description' => 'required|string',
                'features' => 'required|string',
            ]);

            SubscriptionPlan::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'billing_cycle' => $request->billing_cycle,
                'duration_unit' => $request->duration_unit,
                'duration_value' => $request->duration_value,
                'description' => $request->description,
                'features' => json_encode(
                    collect(json_decode($request->features))->pluck('value')->map('trim')->toArray()
                ),
            ]);

            return redirect()->route('admin.subscription.index')->with('success', 'Subscription created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit($encryptedId)
    {
        $id = decrypt($encryptedId);
        $subscription = SubscriptionPlan::find($id);
        // dump($subscription);
        return view('admin.subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'billing_cycle' => 'required|in:day,month,annual',
                'duration_unit' => 'nullable|integer|min:3',
                'duration_value' => 'nullable|integer|min:1',
                'description' => 'required|string',
                'features' => 'required|string',
            ]);

            $subscription = SubscriptionPlan::findOrFail($id);

            $subscription->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'billing_cycle' => $request->billing_cycle,
                'duration_unit' => $request->duration_unit,
                'duration_value' => $request->duration_value,
                'description' => $request->description,
                'features' => json_encode(
                    collect(json_decode($request->features))->pluck('value')->map('trim')->toArray()
                ),
            ]);

            return redirect()->route('admin.subscription.index')->with('success', 'Subscription updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        try {
            $id = decrypt($encryptedId);
            $subscription = SubscriptionPlan::findOrFail($id);
            $subscription->delete();

            return redirect()->route('admin.subscription.index')->with('success', 'Subscription deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
