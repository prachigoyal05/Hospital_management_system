@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-blue-400 overflow-hidden">
        <!-- Form Header -->
        <div class="px-6 py-4 border-b border-blue-100 bg-green">
            <h2 class="text-xl font-semibold text-green-600">Add New Lab Test</h2>
            <p class="text-sm text-black-500 mt-1">Fill in the details below to create a new lab test</p>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.lab-tests.store') }}" method="POST" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-blaCK-600">Test Name *</label>
                    <input type="text" name="name" class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-black-600">Category</label>
                    <select name="category" class="block w-full rounded-md border-green-200 shadow-sm focus:border-black-500 focus:ring-green">
                        <option value="">Select Category</option>
                        <option value="Hematology">Hematology</option>
                        <option value="Biochemistry">Biochemistry</option>
                        <option value="Microbiology">Microbiology</option>
                        <option value="Pathology">Pathology</option>
                        <option value="Radiology">Radiology</option>
                    </select>
                </div>

                <!-- Price Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-black-600">Price (₹) *</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">₹</span>
                        </div>
                        <input type="number" step="0.01" min="0" name="price" class="block w-full pl-8 rounded-md border-blue-200 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Turnaround Time -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-black-600">Turnaround Time</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="text" name="turnaround_time" class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. 24-48 hours">
                    </div>
                </div>

                <!-- Description Field -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-black-600">Description</label>
                    <textarea name="description" rows="3" class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <!-- Test Requirements -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-black-600">Test Requirements</label>
                     <textarea name="test_requirements" rows="3" class="w-full border px-3 py-2 rounded">{{ old('test_requirements', $test->test_requirements ?? '') }}</textarea>
                       </div>
            </div>

            <!-- Form Footer -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.lab-tests.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-green-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save Lab Test
                </button>
            </div>
        </form>
    </div>
</div>
@endsection