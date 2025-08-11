<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sample;


class SampleController extends Controller
{
    public function index()
    {
        $samples = Sample::latest()->get();
        return view('staff.samples.index', compact('samples'));// ✅ Must be a Blade file
    }

    public function create()
{
    $patients = \App\Models\Patient::all(); // or add conditions if needed
    return view('staff.samples.create', compact('patients'));
}


    public function store(Request $request)
    {
        // Handle f $validated = $request->validate([
            $validated = $request->validate([
        // 'Sample_id' =>'somevalue',
        'patient_id' => 'required|exists:patients,id',
        'sample_type' => 'required|string|max:255',
        'test_type'=>'required|string|max:255',
        'collection_date' => 'required|date',
        'submission_date' => 'required|date',
        'status' => 'required|string|max:50',
        'remarks' => 'nullable|string',
    ]);

    // Save to database
    Sample::create($validated);

    return redirect()->route('staff.samples.index')->with('success', 'Sample submitted successfully!');

    // return view('staff.samples.index', compact('samples'));
    
 
}
}
