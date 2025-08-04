<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(10);
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
       public function store(Request $request)
    {
         $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:patients,email',
        'phone' => 'required|string|max:20',
        'dob' => 'required|date',
        // 'gender' => 'required|in:male,female,other',
        'address' => 'nullable|string',
    ]);

    Patient::create($validated);

        return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully.');
    }

    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
{
    return view('admin.patients.edit', compact('patient'));
}


public function update(Request $request, Patient $patient)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'dob' => 'nullable|date',
        'address' => 'nullable|string',
    ]);

    $patient->update($validated);

    return redirect()->route('admin.dashboard')->with('success', 'Patient added successfully!');
}


    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('admin.patients.index')->with('success', 'Patient deleted successfully.');
    }
}