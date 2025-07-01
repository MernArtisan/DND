<?php

namespace App\Http\Controllers\admin;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    public function newsletter(Request $request)
    {   

        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
        ]);

        Newsletter::create([
            'email' => $request->email,
            'status' => false,
        ]);

        return response()->json(['message' => 'You have successfully subscribed.']);
    }

    public function index(){
        $newsletters = Newsletter::all();
        return view('admin.newsletter.index', compact('newsletters'));
    }
}
