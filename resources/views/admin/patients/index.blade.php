@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold mb-4">Patients</h1>
        <a href="{{ route('admin.patients.create') }}" class="px-4 py-2 bg-green-500 text-blue rounded">Add Patient</a>
    </div>



    @if(session('success'))
        <table class="w-full table-fixed border bg-white rounded break-words">
    @endif
       <table class="w-full table-fixed border bg-white rounded">
    <thead>
        <tr class="bg-green-200">
            <th class="p-2 text-left w-1/6">Name</th>
            <th class="p-2 w-48">Email</th>

            <th class="p-2 text-left w-1/6">Phone</th>
            <th class="p-2 text-left w-1/6">Date of birth</th>
            <th class="p-2 text-left w-1/6">Address</th>
            <th class="p-2 text-left w-1/6">Actions</th>
        </tr>
    </thead>

    
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td class="p-2">{{ $patient->name }}</td>
                    <td class="p-2 whitespace-normal break-words break-all w-48">
                        {{ $patient->email }}
                    </td>

                    <td class="p-2">{{ $patient->phone }}</td>
                    <td class="p-2">{{ $patient->dob}}</td>
                    <td class="p-2">{{ $patient->address}}</td>
                    <td class="p-2">
                    <a href="{{ route('admin.patients.edit', $patient->id) }}" class="text-blue-600 hover:underline">Edit</a>

                        <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Delete this patient?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6"class="p-4 text-center">No patients found.</td></tr>
            @endforelse
        </tbody>
    </table> 


    
    <div class="mt-4">
       @if ($patients->hasPages())
    <div class="flex justify-between items-center mt-4">
        @if ($patients->onFirstPage())
            <span class="px-4 py-2 border rounded text-gray-400">&laquo; Previous</span>
        @else
            <a href="{{ $patients->previousPageUrl() }}" class="px-4 py-2 border rounded text-blue-600 hover:bg-blue-50">&laquo; Previous</a>
        @endif
        
        @if ($patients->hasMorePages())
            <a href="{{ $patients->nextPageUrl() }}" class="px-4 py-2 border rounded text-blue-600 hover:bg-blue-50">Next &raquo;</a>
        @else
            <span class="px-4 py-2 border rounded text-gray-400">Next &raquo;</span>
        @endif
    </div>
@endif
    </div>

@endsection
