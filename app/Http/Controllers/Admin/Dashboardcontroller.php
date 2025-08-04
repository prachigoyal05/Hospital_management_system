<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        $recentPatients = Patient::latest()->take(5)->get();
        return view('admin.dashboard', compact('recentPatients'));
    }
}
