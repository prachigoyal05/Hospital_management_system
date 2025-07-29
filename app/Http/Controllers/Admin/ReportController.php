<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Patient;
use App\Models\LabTest;

class ReportController extends Controller
{
    
    public function index()
{
    $reports = Report::with(['patient', 'labTest'])->paginate(10);
    return view('admin.reports.index', compact('reports'));
}

public function create()
{
    $patients = Patient::all();
    $tests = LabTest::all();
    return view('admin.reports.create', compact('patients', 'tests'));
}

public function store(Request $request)
{
    $request->validate([
        'patient_id' => 'required',
        'lab_test_id' => 'required',
        'report_date' => 'required|date',
        'result' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

   
    ]);
    if ($request->hasFile('file')) {
    // Store in 'reports' directory within storage/app/public
    $path = $request->file('file')->store('reports', 'public');
    $validated['file_path'] = $path;  
    }
    
    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('reports', 'public');
    }

    Report::create([
        'patient_id' => $request->patient_id,
        'lab_test_id' => $request->lab_test_id,
        'report_date' => $request->report_date,
        'result' => $request->result,
        'file_path' => $filePath,
    ]);

    return redirect()->route('admin.reports.index')->with('success', 'Report added successfully.');
}
}
