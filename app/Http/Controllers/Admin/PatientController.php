<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Imports\PatientsImport;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
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
            'address' => 'nullable|string',
        ]);

        // Set is_active to true by default for new patients
        $validated['is_active'] = true;
        
        Patient::create($validated);

        return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email,'.$patient->id,
            'phone' => 'nullable|string',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
              'is_active' => 'required|boolean'
        ]);

        $patient->update($validated);

        return redirect()->route('admin.patients.index')->with('success', 'Patient updated successfully!');
    }

    /**
     * Toggle patient active status
     */
   public function toggleStatus(Patient $patient)
{
    // Toggle the status
    $patient->update(['is_active' => !$patient->is_active]);
    
    
    // Get the new status after update
    $newStatus = $patient->fresh()->is_active ? 'activated' : 'deactivated';

    
    return back()->with('success', "Patient {$newStatus} successfully");
}

    /**
     * Get active patients for reports (example method)
     */
    public function activePatientsReport()
    {
        $activePatients = Patient::where('is_active', true)
                               ->orderBy('name')
                               ->get();

        
        // For demonstration - you would typically use this in your report views
        return view('admin.reports.patients', compact('activePatients'));
    }
     public function importView()
    {
        return view('admin.patients.import');
    }

    /**
     * Handle CSV import
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls'
        ]);

        try {
            $import = new PatientsImport();
            Excel::import($import, $request->file('file'));
            
            $successCount = $import->getSuccessCount();
            $errors = $import->getErrors();
            
            if (count($errors) > 0) {
                return redirect()->back()
                    ->with('import_errors', $errors)
                    ->with('success', "Successfully imported {$successCount} patients, with ".count($errors)." errors");
            }
            
            return redirect()->back()
                ->with('success', "Successfully imported {$successCount} patients");
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error during import: '.$e->getMessage());
        }
    }

}