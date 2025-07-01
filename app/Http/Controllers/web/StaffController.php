<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $teams = Team::where('status', 1)->get();
        return view('web.staff.index',[
            'teams'=> $teams
        ]);
    }
}
