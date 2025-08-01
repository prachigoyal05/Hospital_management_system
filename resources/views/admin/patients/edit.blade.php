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

            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
@endsection
