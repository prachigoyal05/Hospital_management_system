@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Patient</h2>

        <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $patient->name) }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $patient->email) }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $patient->phone) }}" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $patient->dob) }}" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Address</label>
                <textarea name="address" class="w-full border px-3 py-2 rounded">{{ old('address', $patient->address) }}</textarea>
            </div>

            <!-- Add Status Toggle -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Account Status</label>
                <div class="flex items-center">
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" name="is_active" value="1" 
                            {{ $patient->is_active ? 'checked' : '' }} class="form-radio text-blue-600">
                        <span class="ml-2">Active</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_active" value="0" 
                            {{ !$patient->is_active ? 'checked' : '' }} class="form-radio text-red-600">
                        <span class="ml-2">Inactive</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Patient</button>
                <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Cancel</a>
            </div>
        </form>
    </div>
@endsection