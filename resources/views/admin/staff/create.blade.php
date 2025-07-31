@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Form Container -->
    <div class="bg-white rounded-lg shadow-sm border border-blue-100 overflow-hidden">
        <!-- Form Header -->
        <div class="px-6 py-4 border-b border-blue-100 bg-blue-50">
            <h2 class="text-xl font-semibold text-blue-600">Add New Staff Member</h2>
            <p class="text-sm text-blue-500 mt-1">Fill in the details below to create a new staff account</p>
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
        <form action="{{ route('admin.staff.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-blue-600">Full Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-blue-600">Email Address *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                           class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-blue-600">Password *</label>
                    <input type="password" name="password" id="password" 
                           class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <p class="mt-1 text-xs text-blue-500">Minimum 8 characters</p>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-blue-600">Confirm Password *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Role Selection -->
                <div class="space-y-2">
    <label for="role" class="block text-sm font-medium text-blue-600">Role *</label>
    <select name="role" id="role" class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
        <option value="">Select Role</option>
        <option value="staff" {{ old('role', $staff->role ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>
       
    </select>
</div>

                <!-- Department (Optional) -->
                <div class="space-y-2">
                    <label for="department" class="block text-sm font-medium text-blue-600">Department</label>
                    <input type="text" name="department" id="department" value="{{ old('department') }}" 
                           class="block w-full rounded-md border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('admin.staff.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Create Staff Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection