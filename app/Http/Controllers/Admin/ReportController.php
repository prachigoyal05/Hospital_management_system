<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Patient;
use App\Models\LabTest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    
    public function index()
{
    $reports = Report::with(['patient', 'labTest'])->paginate(10);
    return view('admin.reports.index', compact('reports'));
}

public function create()
{
    $patients = Patient::where('is_active', true)->orderBy('name')->get();
    $tests = LabTest::all();
    return view('admin.reports.create', compact('patients', 'tests'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'patient_id' => [
            'required',
            'exists:patients,id',
            function ($attribute, $value, $fail) {
                $patient = Patient::find($value);
                if (!$patient || !$patient->is_active) {
                    $fail('The selected patient is inactive or does not exist.');
                }
            }
        ],
        'lab_test_id' => 'required|exists:lab_tests,id',
        'report_date' => 'required|date',
        'result' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // Handle newlines in results
    if ($request->has('result')) {
        $validated['result'] = str_replace(["\r\n", "\r"], "\n", $request->input('result'));
    }

    // Handle file upload
    if ($request->hasFile('file')) {
        $validated['file_path'] = $request->file('file')->store('reports', 'public');
    }

    // Create the report
    $report = Report::create([
        'patient_id' => $validated['patient_id'],
        'lab_test_id' => $validated['lab_test_id'],
        'report_date' => $validated['report_date'],
        'result' => $validated['result'] ?? null, // Handle null result
        'file_path' => $validated['file_path'] ?? null,
    ]);

    return redirect()->route('admin.reports.index')
        ->with('success', 'Report created successfully');
}

public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Report created successfully');
    }

public function download(Report $report)
{
     Log::info("Checking file at path: " . $report->file_path);
    // Check if file exists
    if (!Storage::exists($report->file_path)) {
        abort(404);
    }

    // Get file name with proper extension
    $fileName = pathinfo($report->file_path, PATHINFO_BASENAME);
    $fileExtension = pathinfo($report->file_path, PATHINFO_EXTENSION);
    $downloadName = "report-{$report->id}-{$report->patient->name}.{$fileExtension}";
    
    // Force download
    return Storage::download($report->file_path, $downloadName);
}
}
