@extends('layouts.staff')

@section('title', 'Staff Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-red-500">Welcome, <span class="text-blue-500">{{ Auth::user()->name }}</span>!</h1>
            <p class="text-gray-500 mt-1">Laboratory overview and today's tasks</p>
        </div>
        <div class="mt-4 md:mt-0">
            <div class="relative">
                <input type="text" placeholder="Search samples, patients..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 w-full md:w-64">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Samples Collected Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Samples Collected Today</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">{{ $todaySamples ?? 0 }}</p>
                    <p class="mt-1 text-xs text-green-600 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> {{ $sampleIncreasePercentage ?? 'N/A' }}% from yesterday
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-vial text-blue-600"></i>
                </div>
            </div>
        </div>

        <!-- Pending Tests Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pending Tests</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">{{ $pendingTests ?? 'N/A' }}</p>
                    <div class="mt-1 flex items-center space-x-1">
                        <span class="text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded-full">{{ $urgentTests ?? 'N/A' }} urgent</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
            </div>
        </div>

        <!-- Completed Tests Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">{{ $completedTests ?? 'N/A' }}</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">{{ $urgentTests ?? 'N/A' }}</p>
                    <p class="mt-1 text-xs text-gray-500">Last 7 days</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Test Types Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Test Types</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-800">{{ $testTypesCount ?? 'N/A' }}</p>
                    <p class="mt-1 text-xs text-gray-500">Available tests</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-flask text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Samples Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-medium text-gray-800">Recent Samples</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @isset($recentSamples)
            @forelse($recentSamples as $sample)
            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-start">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-4 mt-1">
                        <i class="fas fa-vial text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-800">Sample #{{ $sample->sample_id }}</h4>
                            <span class="text-xs text-gray-500">{{ $sample->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
    Patient: {{ $sample->patient_name ?? 'Unknown Patient' }}
    | Test: {{ $sample->test_type }}
</p>
                        <div class="mt-2 flex items-center space-x-2">
                            <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded">{{ $sample->sample_type }}</span>
                            <span class="text-xs {{ $sample->status == 'pending' ? 'bg-yellow-50 text-yellow-600' : 'bg-green-50 text-green-600' }} px-2 py-1 rounded">{{ ucfirst($sample->status) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-4 text-center text-gray-500">
                No recent samples found
            </div>
            @endforelse
            @endisset    
        </div>
        <div class="px-6 py-3 border-t border-gray-200 text-center">
            <a href="{{ route('staff.samples.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">View all samples</a>
        </div>
    </div>

    <!-- Quick Actions and Test Distribution -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-medium text-blue-600 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('staff.samples.create') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <i class="fas fa-plus text-blue-600"></i>
                    </div>
                    <span class="font-medium">Register New Sample</span>
                </a>
                <a href="{{ route('staff.tests.create') }}" class="flex items-center p-3 rounded-lg hover:bg-green-50 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <i class="fas fa-flask text-green-600"></i>
                    </div>
                    <span class="font-medium">Record Test Results</span>
                </a>
                <a href="{{ route('staff.reports.index') }}" class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                        <i class="fas fa-file-alt text-purple-600"></i>
                    </div>
                    <span class="font-medium">Generate Reports</span>
                </a>
            </div>
        </div>
        
        <!-- Test Type Distribution -->
        @if(isset($testTypeDistribution))
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:col-span-2">
        <h3 class="text-lg font-medium text-blue-600 mb-4">Test Type Distribution</h3>
        <div class="h-64">
            <canvas id="testTypeChart"></canvas>
        </div>
    </div>
@endif
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
        Logout
    </button>
</form>




    </div>
</div>
@endsection

@section('scripts')
@if(isset($testTypeDistribution))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('testTypeChart').getContext('2d');
        const testTypeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($testTypeDistribution->pluck('test_type')),
                datasets: [{
                    label: 'Number of Tests',
                    data: @json($testTypeDistribution->pluck('count')),
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ]
                }]
            }
        });
    });
</script>
@endif

@endsection