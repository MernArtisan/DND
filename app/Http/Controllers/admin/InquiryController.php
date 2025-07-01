<?php

namespace App\Http\Controllers\admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{

    public function index()
    {
        $inquiries = Inquiry::all();
        return view('admin.inquiry.index', [
            'inquiries' => $inquiries
        ]);
    }
}
