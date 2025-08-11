<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Report;
use App\Models\Sample;
use App\Models\LabTest;




class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $todayPatients = Patient::whereDate('created_at', today())->count();
        $lastWeekPatients = Patient::whereBetween('created_at', [now()->subDays(7), now()])->count();
        $totalSamples = Sample::count();
    
        $sampleTypes = Sample::select('sample_type', \DB::raw('count(*) as total'))
                            ->groupBy('sample_type')
                            ->get();
    
        $testTypeDistribution = Sample::select('test_type', \DB::raw('count(*) as total'))
                                      ->groupBy('test_type')
                                      ->get();
    
        $recentPatients = Patient::latest()->take(5)->get();
        $recentReports = Report::with('patient')->latest()->take(5)->get();
        $recentLabTests = LabTest::with('patient')->latest()->take(5)->get(); // ✅ Real-time lab tests
    
        return view('admin.dashboard', compact(
            'totalPatients',
            'todayPatients',
            'lastWeekPatients',
            'totalSamples',
            'sampleTypes',
            'testTypeDistribution',
            'recentPatients',
            'recentReports',
            'recentLabTests' // ✅ Pass lab tests to the view
        ));
    }
}    