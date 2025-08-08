<!-- add form-->
 @extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Form Container -->
    <div class="bg-white rounded-lg shadow-sm border border-blue-100 overflow-hidden">
        <!-- Form Header -->
        <div class="px-6 py-4 border-b border-blue-100 bg-blue-50">
            <h2 class="text-xl font-semibold text-green-600">Add New Report</h2>
            <p class="text-sm text-black-500 mt-1">Fill in the details below to create a new test report</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mx-6 mt-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-700">There were {{ $errors->count() }} errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-600">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Content -->
        <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Patient Selection -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-greeb-600">Patient *</label>
                    <select name="patient_id" class="block w-full rounded-md border-green-200 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        <option value="">Select Patient</option>
                         @foreach($patients as $patient)
        <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->id }})</option>
    @endforeach
                    
                    </select>
                </div>

                <!-- Lab Test Selection -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-black-600">Lab Test *</label>
                    <select name="lab_test_id" class="block w-full rounded-md border-green-200 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        <option value="">Select Lab Test</option>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}" {{ old('lab_test_id') == $test->id ? 'selected' : '' }}>
                                {{ $test->name }} (₹{{ number_format($test->price, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Report Date -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-black-600">Report Date *</label>
                    <input type="date" name="report_date" value="{{ old('report_date') ?? now()->format('Y-m-d') }}" 
                           class="block w-full rounded-md border-green-200 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-black-600">Status</label>
                    <select name="status" class="block w-full rounded-md border-blue-200 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                </div>
            </div>

            <!-- Result -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-black-600">Result</label>
                <textarea name="result" rows="3" class="block w-full rounded-md border-green-200 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('result') }}</textarea>
            </div>

            <!-- File Upload -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-black-600">Upload Report File (PDF/Image)</label>
                <div class="mt-1 flex items-center">
                    <input type="file" name="file" id="file" 
                           class="block w-full text-sm text-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <p class="mt-1 text-sm text-black-500">Maximum file size: 5MB</p>
            </div>

            <!-- Notes -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-black-600">Notes</label>
                <textarea name="notes" rows="2" class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Any additional notes...">{{ old('notes') }}</textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700  hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-green-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Save Report
                </button>
            </div>
        </form>
    </div>
</div>
@endsection