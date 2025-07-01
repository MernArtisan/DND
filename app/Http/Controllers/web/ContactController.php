<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact.index');
    }


    public function inquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create the inquiry
        Inquiry::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Your inquiry has been submitted successfully.',
        ]);
    }
}
