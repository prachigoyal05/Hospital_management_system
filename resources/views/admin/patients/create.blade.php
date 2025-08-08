@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Add New Patient</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <strong>There were some problems with your input:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.patients.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="{{ old('dob') }}" 
                   max="{{ now()->format('Y-m-d') }}"
                   class="w-full border px-3 py-2 rounded"
                   onchange="validateDOB(this)">
            <p id="dob-error" class="mt-1 text-sm text-red-600 hidden">Date of birth cannot be in the future</p>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Address</label>
            <textarea name="address" rows="3" class="w-full border px-3 py-2 rounded">{{ old('address') }}</textarea>
        </div>

        <!-- Status Toggle (default to active for new patients) -->
        <div class="mb-6">
            <label class="block font-semibold mb-2">Account Status</label>
            <div class="flex items-center">
                <label class="inline-flex items-center mr-4">
                    <input type="radio" name="is_active" value="1" checked class="form-radio text-blue-600">
                    <span class="ml-2">Active</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="is_active" value="0" class="form-radio text-red-600">
                    <span class="ml-2">Inactive</span>
                </label>
            </div>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add Patient</button>
            <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Cancel</a>
        </div>
    </form>
</div>

<script>
function validateDOB(input) {
    const errorElement = document.getElementById('dob-error');
    const selectedDate = new Date(input.value);
    const today = new Date();
    
    if (selectedDate > today) {
        errorElement.classList.remove('hidden');
        input.value = '';
        input.focus();
    } else {
        errorElement.classList.add('hidden');
    }
}
</script>
@endsection