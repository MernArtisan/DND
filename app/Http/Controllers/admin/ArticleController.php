<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('images')->paginate(10);
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable',
                'images' => 'required|array',
                'images.*' => 'image|mimes:png,jpg,jpeg|max:10240',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $article = Article::create([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug($request->name),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('articles', 'public'); // stores in storage/app/public/articles

                    ArticleImages::create([
                        'article_id' => $article->id,
                        'image' => 'storage/' . $path, // use this path in <img src="">
                    ]);
                }
            }

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
    public function edit($encryptedId)
    {
        $id = decrypt($encryptedId);
        $article = Article::with('images')->findOrFail($id);
        return view('admin.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:png,jpg,jpeg|max:10240',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $article = Article::with('images')->findOrFail($id);

            $article->update([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug($request->name),
            ]);

            // ✅ Store new images (if provided)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('articles', 'public');

                    ArticleImages::create([
                        'article_id' => $article->id,
                        'image' => 'storage/' . $path,
                    ]);
                }
            }

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        $id = decrypt($encryptedId);
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->back()->with('success', 'Article Deleted Successfully');
    }
    public function deleteImage(Request $request)
    {
        try {
            $image = ArticleImages::find($request->id);

            if (!$image) {
                return response()->json(['success' => false, 'message' => 'Image not found.']);
            }

            // Delete the image file from storage
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

            // Delete the DB record
            $image->delete();

            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
