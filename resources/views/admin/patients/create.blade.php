@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">

    <h2 class="text-2xl font-semibold mb-6 text-center">Add New Patient</h2>

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

    <form action="{{ route('admin.patients.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Full Name</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Email (optional)</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium">Phone Number</label>
            <input type="text" name="phone" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium">Date of Birth</label>
            <input type="date" name="dob" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium">Address</label>
            <textarea name="address" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="bg-green-600 hover:bg--700 text-white px-4 py-2 rounded">Add Patient</button>
            <a href="{{ route('admin.patients.index') }}" class="bg-white-600 hover:bg-green-700 text-black px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
