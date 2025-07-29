<!-- list reports-->
 @extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header with action buttons -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl font-semibold text-blue-600">Test Reports</h2>
            <p class="text-sm text-blue-500">View and manage all laboratory test reports</p>
        </div>
        <a href="{{ route('admin.reports.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Report
        </a>
    </div>

    <!-- Reports Table -->
    <div class="bg-white rounded-lg shadow-sm border border-blue-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Patient</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Test</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Result</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">File</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-200">
                    @foreach ($reports as $report)
                        <tr class="hover:bg-blue-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-blue-900">{{ $report->patient->name }}</div>
                                <div class="text-sm text-blue-500">{{ $report->patient->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-blue-900">{{ $report->labTest->name }}</div>
                                <div class="text-sm text-blue-500">{{ $report->labTest->category }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                                {{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                        'delivered' => 'bg-green-100 text-green-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$report->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-blue-600 max-w-xs truncate">
                                @if ($report->file_path)
                    <a href="{{ Storage::url($report->file_path) }}" 
                       target="_blank" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        View
                    </a>
                @else
                    <span class="text-gray-400">N/A</span>
                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.reports.edit', $report->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($reports->hasPages())
            <div class="bg-blue-50 px-6 py-3 border-t border-blue-100">
                {{ $reports->links() }}
            </div>
        @endif
    </div>
</div>
@endsection