<?php

namespace App\Http\Controllers\admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{

    public function index()
    {
        $inquiries = Inquiry::latest()->get();
        return view('admin.inquiry.index', [
            'inquiries' => $inquiries,
        ]);
    }

    public function markAsRead($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        if (!$inquiry->is_read) {
            $inquiry->update(['is_read' => 1]);
        }
        return response()->json(['message' => 'Marked as read']);
    }
}
