<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function create()
    {
        return view('staff.samples.create');
    }
    public function index()
{
    if (auth()->user()->role !== 'staff') {
        abort(403, 'Unauthorized access.');
    }

    // Fetch stats/data for staff
    return view('staff.dashboard');
}
    //
}
