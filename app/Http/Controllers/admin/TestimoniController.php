<?php

namespace App\Http\Controllers\admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view("admin.testimonials.index", [
            "testimonials" => $testimonials
        ]);
    }

    public function create()
    {
        return view("admin.testimonials.manage");
    }
    public function store(Request $request)
    {
        // dump($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload using Storage
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials', 'public');
            $validated['image'] = $path;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }


    public function edit($encryptedId)
    {
        $id = decrypt($encryptedId);
        $testimonial = Testimonial::find($id);
        return view('admin.testimonials.manage', [
            'testimonial' => $testimonial
        ]);
    }

    public function update(Request $request, $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $testimonial = Testimonial::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }


            $path = $request->file('image')->store('testimonials', 'public');
            $validated['image'] = $path;
        }


        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $testimonial = Testimonial::findOrFail($id);

            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->delete();

            return redirect()->route('admin.testimonials.index')->with('success', 'testimonials deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
