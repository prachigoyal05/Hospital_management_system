@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold mb-4">Patients</h1>
        <a href="{{ route('admin.patients.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Add Patient</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border bg-white rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Name</th>
                <th class="p-2 text-left">Email</th>
                <th class="p-2 text-left">Phone</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td class="p-2">{{ $patient->name }}</td>
                    <td class="p-2">{{ $patient->email }}</td>
                    <td class="p-2">{{ $patient->phone }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.patients.edit', $patient) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Delete this patient?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="p-4 text-center">No patients found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $patients->links() }}
    </div>
@endsection
